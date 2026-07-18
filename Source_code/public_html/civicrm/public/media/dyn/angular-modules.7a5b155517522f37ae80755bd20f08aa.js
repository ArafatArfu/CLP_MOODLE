(function(angular, $, _) {
  angular.module('ng')
    .config(['$locationProvider', function($locationProvider) {
      $locationProvider.hashPrefix('');
    }]);


angular.module('api4', CRM.angRequires('api4'));

angular.module('api4').factory('crmApi4', function($q) {
    var crmApi4 = function(entity, action, params, index) {
      var deferred = $q.defer();
      var p;
      var backend = crmApi4.backend || CRM.api4;
      if (_.isObject(entity)) {
        /*jshint -W061 */
        p = backend(eval('('+angular.toJson(entity)+')'), action);
      } else {
        /*jshint -W061 */
        p = backend(entity, action, eval('('+angular.toJson(params)+')'), index);
      }
      p.then(
        function(result) {
          deferred.resolve(result);
        },
        function(error) {
          deferred.reject(error);
        }
      );
      return deferred.promise;
    };
    crmApi4.backend = null;
    crmApi4.val = function(value) {
      var d = $.Deferred();
      d.resolve(value);
      return d.promise();
    };
    return crmApi4;
  });

})(angular, CRM.$, CRM._);

(function (angular) {
  "use strict";

  angular.module('crmResetPassword', CRM.angRequires('crmResetPassword'));

  angular.module('crmResetPassword').component('crmResetPassword', {
    templateUrl: '~/crmResetPassword/crmResetPassword.html',
    bindings: {
      hibp: '@',
      token: '@'
    },
    controller: function($scope, $timeout, crmApi4) {
      var ts = $scope.ts = CRM.ts(null),
      ctrl = this;

      ctrl.completeReset = () => {
        ctrl.busy='';
        ctrl.formSubmitted = false;
        ctrl.identifier = '';
        ctrl.newPassword = '';
        ctrl.newPasswordAgain = '';
        ctrl.pwnd = false;
        ctrl.resetSuccessfullySubmitted=false;
        ctrl.token='';
      };
      ctrl.completeReset();

      let updateAngular = (prop, newVal) => {
        $timeout(() => {
          console.log("Setting", prop, "to", newVal);
          ctrl[prop] = newVal;
        }, 0);
      };
      ctrl.requestPasswordResetEmail = () => {
        updateAngular('busy', ts('Just a moment...'));
        updateAngular('formSubmitted', true);
        if (!ctrl.identifier) {
          alert(ts('Please provide your username or email.'));
          return;
        }
        crmApi4('User', 'requestPasswordResetEmail', { identifier: ctrl.identifier })
        .then(r => {
          updateAngular('busy', '');
          updateAngular('resetSuccessfullySubmitted', true);
        })
        .catch(e => {
          updateAngular('busy', ts('Sorry, something went wrong. Please contact your site administrators.'));
        });
      };

      ctrl.attemptChange = () => {
        updateAngular('busy', '');
        updateAngular('formSubmitted', true);
        updateAngular('pwnd', false);
        if (ctrl.newPassword.length < 8) {
          alert(ts("Passwords under 8 characters are not secure. Ideally you should use a secure password generator."));
          return;
        }
        if (ctrl.newPassword != ctrl.newPasswordAgain) {
          updateAngular('formSubmitted', false);
          alert(ts("Passwords do not match"));
          return;
        }

        let promises = Promise.resolve(null);
        if (ctrl.hibp) {
          promises = promises.then(() => {
            updateAngular('busy', ts('Checking password is not known to have been involved in data breach...'));
            return sha1(ctrl.newPassword)
              .then(hash => {
                if (!hash.match(/^[a-f0-9]+$/)) {
                  updateAngular('busy', ts('Could not check. Is your browser up-to-date?'));
                }
                else {
                  hash = hash.toUpperCase();
                  let hashPrefix = hash.substring(0, 5);
                  return fetch(ctrl.hibp + hashPrefix)
                    .then(r => r.text())
                    .then(hibpResult => {
                      if (hibpResult &&
                        hibpResult.split(/\r\n/).find(line => hashPrefix + line.replace(/:\d+$/, '') === hash)) {
                        updateAngular('pwn', true);
                        return;
                      }
                      updateAngular('busy', '');
                    })
                    .catch( () => {
                      updateAngular('busy', ts('Could not perform check; service error.'));
                    });
                }
              });
          });
        }

        promises = promises.then(() => {
          updateAngular('busy', ctrl.busy + ts('Changing...'));
          updateAngular('formSubmitted', true);
          return crmApi4('User', 'passwordReset', {
              token: ctrl.token,
              password: ctrl.newPassword,
            })
            .then(r => {
              updateAngular('busy', ts('Password successfully updated. Redirecting to login...'));
              $timeout(() => {
                window.location = '/civicrm/login';
              }, 1300);
            })
            .catch(e => {
              updateAngular('token', 'invalid');
            });
        });
      };
      function sha1(message) {
        const encoder = new TextEncoder();
        const data = encoder.encode(message);
        return crypto.subtle.digest('SHA-1', data)
          .then(hashBuffer => {
            const hashArray = Array.from(new Uint8Array(hashBuffer)); // convert buffer to byte array
            const hashHex = hashArray
            .map((b) => b.toString(16).padStart(2, "0"))
            .join(""); // convert bytes to hex string
            return hashHex;
          });
      }
    }
  });
})(angular);

(function(angular, $, _) {
  angular.module('crmResource', []);

  angular.module('crmResource').factory('crmResource', function($q, $http) {
    var deferreds = {}; // null|object; deferreds[url][idx] = Deferred;

    var notify = function notify() {
      var oldDfrds = deferreds;
      deferreds = null;

      angular.forEach(oldDfrds, function(dfrs, url) {
        if (CRM.angular.templates[url]) {
          angular.forEach(dfrs, function(dfr) {
            dfr.resolve({
              status: 200,
              headers: function(name) {
                var headers = {'Content-type': 'text/html'};
                return name ? headers[name] : headers;
              },
              data: CRM.angular.templates[url]
            });
          });
        }
        else {
          angular.forEach(dfrs, function(dfr) {
            dfr.reject({status: 500}); // FIXME
          });
        }
      });
    };

    var moduleUrl = CRM.angular.bundleUrl;
    $http.get(moduleUrl)
      .then(function httpSuccess(response) {
        CRM.angular.templates = CRM.angular.templates || {};
        angular.forEach(response.data, function (module) {
          if (module.partials) {
            angular.extend(CRM.angular.templates, module.partials);
          }
          if (module.strings) {
            CRM.addStrings(module.domain, module.strings);
          }
        });
        notify();
      }, function httpError() {
        notify();
      });

    return {
      getUrl: function getUrl(url) {
        if (CRM.angular.templates && CRM.angular.templates[url]) {
          return CRM.angular.templates[url];
        }
        else {
          var deferred = $q.defer();
          if (!deferreds[url]) {
            deferreds[url] = [];
          }
          deferreds[url].push(deferred);
          return deferred.promise;
        }
      }
    };
  });

  angular.module('crmResource').config(function($provide) {
    $provide.decorator('$templateCache', function($delegate, $http, $q, crmResource) {
      var origGet = $delegate.get;
      var urlPat = /^~\//;
      $delegate.get = function(url) {
        if (urlPat.test(url)) {
          return crmResource.getUrl(url);
        }
        else {
          return origGet.call(this, url);
        }
      };
      return $delegate;
    });
  });


var uidCount = 0,
    pageTitleHTML = 'CiviCRM',
    documentTitle = 'CiviCRM';

  angular.module('crmUi', CRM.angRequires('crmUi'))
    .directive('crmUiAccordion', function() {
      return {
        scope: {
          crmUiAccordion: '='
        },
        template: '<details class="crm-accordion-bold"><summary>{{crmUiAccordion.title}} <a crm-ui-help="help" ng-if="help"></a></summary><div class="crm-accordion-body" ng-transclude></div></details>',
        transclude: true,
        link: function (scope, element, attrs) {
          scope.help = null;
          let openSet = false;
          scope.$watch('crmUiAccordion', function(crmUiAccordion, oldVal) {
            if (crmUiAccordion) {
              if (!openSet) {
                $(element).children('details').prop('open', !crmUiAccordion.collapsed);
                openSet = true;
              }
              if (crmUiAccordion.help) {
                scope.help = crmUiAccordion.help.clone({}, {
                  title: crmUiAccordion.title
                });
              }
            }
          });
        }
      };
    })
    .service('crmUiAlert', function($compile, $rootScope, $templateRequest, $q) {
      var count = 0;
      return function crmUiAlert(params) {
        var id = 'crmUiAlert_' + (++count);
        var tpl = null;
        if (params.templateUrl) {
          tpl = $templateRequest(params.templateUrl);
        }
        else if (params.template) {
          tpl = params.template;
        }
        if (tpl) {
          params.text = '<div id="' + id + '"></div>'; // temporary stub
        }
        var result = CRM.alert(params.text, params.title, params.type, params.options);
        if (tpl) {
          $q.when(tpl, function(html) {
            var scope = params.scope || $rootScope.$new();
            var linker = $compile(html);
            $('#' + id).append($(linker(scope)));
          });
        }
        return result;
      };
    })
    .directive('crmUiDatepicker', function ($timeout) {
      return {
        restrict: 'AE',
        require: 'ngModel',
        scope: {
          crmUiDatepicker: '='
        },
        link: function (scope, element, attrs, ngModel) {
          ngModel.$render = function () {
            element.val(ngModel.$viewValue).change();
          };
          let settings = angular.copy(scope.crmUiDatepicker || {});
          settings.start_date_years = settings.start_date_years || 100;
          settings.end_date_years = settings.end_date_years || 100;
          $timeout(function() {
            element
              .crmDatepicker(settings)
              .on('change', function () {
                $timeout(function() {
                  let requiredLength = 19;
                  if (settings.time === false) {
                    requiredLength = 10;
                  }
                  if (settings.date === false) {
                    requiredLength = 8;
                  }
                  else if (typeof settings.date === 'string') {
                    var lowerFormat = settings.date.toLowerCase();
                    if (lowerFormat.indexOf('y') < 0 || lowerFormat.indexOf('m') < 0 || lowerFormat.indexOf('d') < 0) {
                      requiredLength = element.val().length;
                    }
                  }
                  ngModel.$setValidity('incompleteDateTime', !(element.val().length && element.val().length !== requiredLength));
                });
              });
          });
        }
      };
    })
    .directive('crmUiDebug', function ($location) {
      return {
        restrict: 'AE',
        scope: {
          crmUiDebug: '@'
        },
        template: function() {
          var args = $location.search();
          if (args && args.angularDebug) {
            var jsonTpl = (CRM.angular.modules.indexOf('jsonFormatter') < 0) ? '<pre>{{data|json}}</pre>' : '<json-formatter json="data" open="1"></json-formatter>';
            return '<div crm-ui-accordion=\'{title: ts("Debug (%1)", {1: crmUiDebug}), collapsed: true}\'>' + jsonTpl + '</div>';
          }
          return '';
        },
        link: function(scope, element, attrs) {
          var args = $location.search();
          if (args && args.angularDebug) {
            scope.ts = CRM.ts(null);
            scope.$parent.$watch(attrs.crmUiDebug, function(data) {
              scope.data = data;
            });
          }
        }
      };
    })
    .directive('crmUiField', function() {
      var templateUrls = {
        default: '~/crmUi/field.html',
        checkbox: '~/crmUi/field-cb.html'
      };

      return {
        require: '^crmUiIdScope',
        restrict: 'EA',
        scope: {
          crmUiField: '='
        },
        templateUrl: function(tElement, tAttrs){
          var layout = tAttrs.crmLayout ? tAttrs.crmLayout : 'default';
          return templateUrls[layout];
        },
        transclude: true,
        link: function (scope, element, attrs, crmUiIdCtrl) {
          $(element).addClass('crm-section');
          scope.help = null;
          scope.$watch('crmUiField', function(crmUiField) {
            if (crmUiField && crmUiField.help) {
              scope.help = crmUiField.help.clone({}, {
                title: crmUiField.title
              });
            }
          });
        }
      };
    })
    .directive('crmUiId', function () {
      return {
        require: '^crmUiIdScope',
        restrict: 'EA',
        link: {
          pre: function (scope, element, attrs, crmUiIdCtrl) {
            var id = crmUiIdCtrl.get(attrs.crmUiId);
            element.attr('id', id);
          }
        }
      };
    })
    .service('crmUiHelp', function(){
      function FieldHelp(options) {
        this.options = options;
      }
      angular.extend(FieldHelp.prototype, {
        get: function(n) {
          return this.options[n];
        },
        open: function open() {
          CRM.help(this.options.title, {id: this.options.id, file: this.options.file});
        },
        clone: function clone(options, defaults) {
          return new FieldHelp(angular.extend({}, defaults, this.options, options));
        }
      });
      return function(defaults){
        return function(options) {
          if (_.isString(options)) {
            options = {id: options};
          }
          return new FieldHelp(angular.extend({}, defaults, options));
        };
      };
    })
    .directive('crmUiHelp', function() {
      return {
        restrict: 'EA',
        link: function(scope, element, attrs) {
          setTimeout(function() {
            var crmUiHelp = scope.$eval(attrs.crmUiHelp);
            var title = crmUiHelp && crmUiHelp.get('title') ? ts('%1 Help', {1: crmUiHelp.get('title')}) : ts('Help');
            element.attr('title', title);
          }, 50);

          element
            .addClass('helpicon')
            .attr('href', '#')
            .on('click', function(e) {
              e.preventDefault();
              scope.$eval(attrs.crmUiHelp).open();
            });
        }
      };
    })
    .directive('crmUiFor', function ($parse, $timeout) {
      return {
        require: '^crmUiIdScope',
        restrict: 'EA',
        template: '<span ng-class="cssClasses"><span ng-transclude/><span crm-ui-visible="crmIsRequired" class="crm-marker" title="This field is required.">*</span></span>',
        transclude: true,
        link: function (scope, element, attrs, crmUiIdCtrl) {
          scope.crmIsRequired = false;
          scope.cssClasses = {};

          if (!attrs.crmUiFor) return;

          var id = crmUiIdCtrl.get(attrs.crmUiFor);
          element.attr('for', id);
          var ngModel = null;

          var updateCss = function () {
            scope.cssClasses['crm-error'] = !ngModel.$valid && !ngModel.$pristine;
          };
          var init = function (retries, retryDelay) {
            var input = $('#' + id);
            if (input.length === 0 && !attrs.crmUiForceRequired) {
              if (retries) {
                $timeout(function(){
                  init(retries-1, retryDelay);
                }, retryDelay);
              }
              return;
            }

            if (attrs.crmUiForceRequired) {
              scope.crmIsRequired = true;
              return;
            }

            var tgtScope = scope;//.$parent;
            if (attrs.crmDepth) {
              for (var i = attrs.crmDepth; i > 0; i--) {
                tgtScope = tgtScope.$parent;
              }
            }

            if (input.attr('ng-required')) {
              scope.crmIsRequired = scope.$parent.$eval(input.attr('ng-required'));
              scope.$parent.$watch(input.attr('ng-required'), function (isRequired) {
                scope.crmIsRequired = isRequired;
              });
            }
            else {
              scope.crmIsRequired = input.prop('required');
            }

            ngModel = $parse(attrs.crmUiFor)(tgtScope);
            if (ngModel) {
              ngModel.$viewChangeListeners.push(updateCss);
            }
          };

          $timeout(function(){
            init(3, 100);
          });
        }
      };
    })
    .directive('crmUiIdScope', function () {
      return {
        restrict: 'EA',
        scope: {},
        controllerAs: 'crmUiIdCtrl',
        controller: function($scope) {
          var ids = {};
          this.get = function(name) {
            if (!ids[name]) {
              ids[name] = "crmUiId_" + (++uidCount);
            }
            return ids[name];
          };
        },
        link: function (scope, element, attrs) {}
      };
    })
    .directive('crmUiIframe', function ($parse) {
      return {
        scope: {
          crmUiIframeSrc: '@', // expression which evaluates to a URL
          crmUiIframe: '@' // expression which evaluates to HTML content
        },
        link: function (scope, elm, attrs) {
          var iframe = $(elm)[0];
          iframe.setAttribute('width', '100%');
          iframe.setAttribute('height', '250px');
          iframe.setAttribute('frameborder', '0');

          var refresh = function () {
            if (attrs.crmUiIframeSrc) {
              iframe.setAttribute('src', scope.$parent.$eval(attrs.crmUiIframeSrc));
            }
            else {
              var iframeHtml = scope.$parent.$eval(attrs.crmUiIframe);

              var doc = iframe.document;
              if (iframe.contentDocument) {
                doc = iframe.contentDocument;
              }
              else if (iframe.contentWindow) {
                doc = iframe.contentWindow.document;
              }

              doc.open();
              doc.writeln(iframeHtml);
              doc.close();
            }
          };
          $(elm).parent().on('dialogresize dialogopen', function(e, ui) {
            $(this).css({padding: '0', margin: '0', overflow: 'hidden'});
            iframe.setAttribute('height', '' + $(this).innerHeight() + 'px');
          });

          $(elm).parent().on('dialogresize', function(e, ui) {
            iframe.setAttribute('class', 'resized');
          });

          scope.$parent.$watch(attrs.crmUiIframe, refresh);
        }
      };
    })
    .directive('crmUiInsertRx', function() {
      return {
        link: function(scope, element, attrs) {
          scope.$on(attrs.crmUiInsertRx, function(e, tokenName) {
            CRM.wysiwyg.insert(element, tokenName);
            $(element).select2('close').select2('val', '');
            CRM.wysiwyg.focus(element);
          });
        }
      };
    })
    .directive('crmUiRichtext', function ($timeout) {
      return {
        require: '?ngModel',
        link: function (scope, elm, attr, ngModel) {
          $timeout(function() {
            var editor = CRM.wysiwyg.create(elm);

            if (!ngModel) {
              return;
            }

            if (attr.ngBlur) {
              $(elm).on('blur', function() {
                $timeout(function() {
                  scope.$eval(attr.ngBlur);
                });
              });
            }

            ngModel.$render = function(value) {
              editor.done(function() {
                CRM.wysiwyg.setVal(elm, ngModel.$viewValue || '');
              });
            };
          });
        }
      };
    })
    .directive('crmUiLock', function ($parse, $rootScope) {
      var defaultVal = function (defaultValue) {
        var f = function (scope) {
          return defaultValue;
        };
        f.assign = function (scope, value) {
        };
        return f;
      };
      var parse = function (expr, defaultValue) {
        return expr ? $parse(expr) : defaultVal(defaultValue);
      };

      return {
        template: '',
        link: function (scope, element, attrs) {
          var binding = parse(attrs.binding, true);
          var titleLocked = parse(attrs.titleLocked, ts('Locked'));
          var titleUnlocked = parse(attrs.titleUnlocked, ts('Unlocked'));

          $(element).addClass('crm-i lock-button');
          var refresh = function () {
            var locked = binding(scope);
            if (locked) {
              $(element)
                .removeClass('fa-unlock')
                .addClass('fa-lock')
                .prop('title', titleLocked(scope))
              ;
            }
            else {
              $(element)
                .removeClass('fa-lock')
                .addClass('fa-unlock')
                .prop('title', titleUnlocked(scope))
              ;
            }
          };

          $(element).click(function () {
            binding.assign(scope, !binding(scope));
            $rootScope.$digest();
          });

          scope.$watch(attrs.binding, refresh);
          scope.$watch(attrs.titleLocked, refresh);
          scope.$watch(attrs.titleUnlocked, refresh);

          refresh();
        }
      };
    })
    .service('CrmUiOrderCtrl', function(){
      function CrmUiOrderCtrl(defaults){
        this.values = defaults;
      }
      angular.extend(CrmUiOrderCtrl.prototype, {
        get: function get() {
          return this.values;
        },
        getDir: function getDir(name) {
          if (this.values.indexOf(name) >= 0 || this.values.indexOf('+' + name) >= 0) {
            return '+';
          }
          if (this.values.indexOf('-' + name) >= 0) {
            return '-';
          }
          return '';
        },
        remove: function remove(name) {
          var idx = this.values.indexOf(name);
          if (idx >= 0) {
            this.values.splice(idx, 1);
            return true;
          }
          else {
            return false;
          }
        },
        setDir: function setDir(name, dir) {
          return this.toggle(name, dir);
        },
        toggle: function toggle(name, next) {
          if (!next && next !== '') {
            next = '+';
            if (this.remove(name) || this.remove('+' + name)) {
              next = '-';
            }
            if (this.remove('-' + name)) {
              next = '';
            }
          }

          if (next == '+') {
            this.values.unshift('+' + name);
          }
          else if (next == '-') {
            this.values.unshift('-' + name);
          }
        }
      });
      return CrmUiOrderCtrl;
    })
    .directive('crmUiOrder', function(CrmUiOrderCtrl) {
      return {
        link: function(scope, element, attrs){
          var options = angular.extend({var: 'crmUiOrderBy'}, scope.$eval(attrs.crmUiOrder));
          scope[options.var] = new CrmUiOrderCtrl(options.defaults);
        }
      };
    })
    .directive('crmUiOrderBy', function() {
      return {
        link: function(scope, element, attrs) {
          function updateClass(crmUiOrderCtrl, name) {
            var dir = crmUiOrderCtrl.getDir(name);
            element
              .toggleClass('sorting_asc', dir === '+')
              .toggleClass('sorting_desc', dir === '-')
              .toggleClass('sorting', dir === '');
          }

          element.on('click', function(e){
            var tgt = scope.$eval(attrs.crmUiOrderBy);
            tgt[0].toggle(tgt[1]);
            updateClass(tgt[0], tgt[1]);
            e.preventDefault();
            scope.$digest();
          });

          var tgt = scope.$eval(attrs.crmUiOrderBy);
          updateClass(tgt[0], tgt[1]);
        }
      };
    })
    .directive('crmUiSelect', function ($parse, $timeout) {
      return {
        require: '?ngModel',
        priority: 1,
        scope: {
          crmUiSelect: '='
        },
        link: function (scope, element, attrs, ngModel) {

          if (ngModel && !attrs.ngOptions) {
            ngModel.$render = function () {
              $timeout(function () {
                var newVal = _.cloneDeep(ngModel.$modelValue);
                if (typeof newVal === 'string' && element.select2('container').hasClass('select2-container-multi')) {
                  newVal = newVal.length ? newVal.split(scope.crmUiSelect.separator || ',') : [];
                }
                element.select2('val', newVal);
              });
            };
          }
          function refreshModel() {
            var oldValue = ngModel.$viewValue, newValue = element.select2('val');
            if (Array.isArray(newValue) && attrs.ngList) {
              newValue = newValue.join(attrs.ngList);
            }
            if (oldValue != newValue) {
              scope.$parent.$apply(function () {
                ngModel.$setViewValue(newValue);
              });
            }
          }

          function init() {
            element.crmSelect2(scope.crmUiSelect || {});
            if (ngModel) {
              element.on('change', refreshModel);
            }
          }
          if (attrs.ngOptions) {
            $timeout(function() {
              element.crmSelect2(scope.crmUiSelect || {});
              ngModel.$render = function () {
                element.val(ngModel.$viewValue || '').change();
              };
            });
          } else {
            $timeout(init);
          }
        }
      };
    })
    .directive('onCrmUiSelect', function () {
      return {
        priority: 10,
        link: function (scope, element, attrs) {
          element.on('select2-selecting', function(e) {
            e.preventDefault();
            element.select2('close').select2('val', '');
            scope.$apply(function() {
              scope.$eval(attrs.onCrmUiSelect, {selection: e.val});
            });
          });
        }
      };
    })
    .directive('crmEntityref', function ($parse, $timeout) {
      return {
        require: '?ngModel',
        scope: {
          crmEntityref: '='
        },
        link: function (scope, element, attrs, ngModel) {

          ngModel.$render = function () {
            $timeout(function () {
              var newVal = _.cloneDeep(ngModel.$modelValue);
              if (typeof newVal === 'string' && element.select2('container').hasClass('select2-container-multi')) {
                newVal = newVal.length ? newVal.split(',') : [];
              }
              element.select2('val', newVal);
            });
          };
          function refreshModel() {
            var oldValue = ngModel.$viewValue, newValue = element.select2('val');
            if (oldValue != newValue) {
              scope.$parent.$apply(function () {
                ngModel.$setViewValue(newValue);
              });
            }
          }

          function init() {
            element.crmEntityRef(scope.crmEntityref || {});
            element.on('change', refreshModel);
            $timeout(ngModel.$render);
          }

          init();
        }
      };
    })
    .directive('crmAutocomplete', function () {
      return {
        require: {
          crmAutocomplete: 'crmAutocomplete',
          ngModel: '?ngModel'
        },
        priority: 100,
        bindToController: {
          entity: '<crmAutocomplete',
          crmAutocompleteParams: '<',
          multi: '<',
          autoOpen: '<',
          quickAdd: '<',
          staticOptions: '<'
        },
        link: function(scope, element, attr, ctrl) {
          var parseList = function(viewValue) {
            if (_.isUndefined(viewValue)) return;

            if (!ctrl.crmAutocomplete.multi) {
              return viewValue;
            }

            var list = [];

            if (viewValue) {
              _.each(viewValue.split(','), function(value) {
                if (value) {
                  list.push(_.trim(value));
                }
              });
            }

            return list;
          };

          if (ctrl.ngModel) {
            ctrl.ngModel.$render = function() {
              const newValue = (ctrl.ngModel.$viewValue === null || ctrl.ngModel.$viewValue === undefined || ctrl.ngModel.$viewValue === false) ? '' : ctrl.ngModel.$viewValue.toString();
              if (newValue !== element.val().toString()) {
                element.val(newValue).change();
              }
            };
            ctrl.ngModel.$parsers.push(parseList);
            ctrl.ngModel.$formatters.push(function(value) {
              return _.isArray(value) ? value.join(',') : value;
            });
            ctrl.ngModel.$isEmpty = function(value) {
              return !value || !value.length;
            };
          }
        },
        controller: function($element, $timeout) {
          var ctrl = this;
          this.$onChanges = function() {
            $timeout(function() {
              $element.crmAutocomplete(ctrl.entity, ctrl.crmAutocompleteParams || {}, {
                multiple: ctrl.multi,
                minimumInputLength: ctrl.autoOpen && _.isEmpty(ctrl.staticOptions) ? 0 : 1,
                static: ctrl.staticOptions || [],
                quickAdd: ctrl.quickAdd,
              });
            });
          };
        }
      };
    })
    .directive('crmMultipleEmail', function ($parse, $timeout) {
      return {
        require: 'ngModel',
        link: function(scope, element, attrs, ctrl) {
          ctrl.$parsers.unshift(function(viewValue) {
            if (_.isEmpty(viewValue)) {
              ctrl.$setValidity('crmMultipleEmail', true);
              return viewValue;
            }
            var emails = viewValue.split(',');
            var emailRegex = /\S+@\S+\.\S+/;

            var validityArr = emails.map(function(str){
              return emailRegex.test(str.trim());
            });

            if ($.inArray(false, validityArr) > -1) {
              ctrl.$setValidity('crmMultipleEmail', false);
            } else {
              ctrl.$setValidity('crmMultipleEmail', true);
            }
            return viewValue;
          });
        }
      };
    })
    .directive('crmUiTab', function($parse) {
      return {
        require: '^crmUiTabSet',
        restrict: 'EA',
        scope: {
          crmTitle: '@',
          crmIcon: '@',
          count: '@',
          id: '@'
        },
        template: '<div ng-transclude></div>',
        transclude: true,
        link: function (scope, element, attrs, crmUiTabSetCtrl) {
          crmUiTabSetCtrl.add(scope);
        }
      };
    })
    .directive('crmUiTabSet', function() {
      return {
        restrict: 'EA',
        scope: {
          crmUiTabSet: '@',
          tabSetOptions: '<'
        },
        templateUrl: '~/crmUi/tabset.html',
        transclude: true,
        controllerAs: 'crmUiTabSetCtrl',
        controller: function($scope, $element, $timeout) {
          var init;
          $scope.tabs = [];
          this.add = function(tab) {
            if (!tab.id) throw "Tab is missing 'id'";
            $scope.tabs.push(tab);
            if (init) {
              $timeout.cancel(init);
            }
            init = $timeout(function() {
              $element.find('.crm-tabset').tabs($scope.tabSetOptions);
            });
          };
        }
      };
    })
    .directive('crmUiValidate', function() {
      return {
        restrict: 'EA',
        require: 'ngModel',
        link: function(scope, element, attrs, ngModel) {
          var validationKey = attrs.crmUiValidateName ? attrs.crmUiValidateName : 'crmUiValidate';
          scope.$watch(attrs.crmUiValidate, function(newValue){
            ngModel.$setValidity(validationKey, !!newValue);
          });
        }
      };
    })
    .directive('crmUiVisible', function($parse) {
      return {
        restrict: 'EA',
        scope: {
          crmUiVisible: '@'
        },
        link: function (scope, element, attrs) {
          var model = $parse(attrs.crmUiVisible);
          function updatecChildren() {
            element.css('visibility', model(scope.$parent) ? 'inherit' : 'hidden');
          }
          updatecChildren();
          scope.$parent.$watch(attrs.crmUiVisible, updatecChildren);
        }
      };
    })
    .directive('crmUiWizard', function() {
      return {
        restrict: 'EA',
        scope: {
          crmUiWizard: '@',
          crmUiWizardNavClass: '@' // string, A list of classes that will be added to the nav items
        },
        templateUrl: '~/crmUi/wizard.html',
        transclude: true,
        controllerAs: 'crmUiWizardCtrl',
        controller: function($scope, $parse) {
          var steps = $scope.steps = []; // array<$scope>
          var crmUiWizardCtrl = this;
          var maxVisited = 0;
          var selectedIndex = null;

          var findIndex = function() {
            var found = null;
            angular.forEach(steps, function(step, stepKey) {
              if (step.selected) found = stepKey;
            });
            return found;
          };
          this.$index = function() { return selectedIndex; };
          this.$first = function() { return this.$index() === 0; };
          this.$last = function() { return this.$index() === steps.length -1; };
          this.$maxVisit = function() { return maxVisited; };
          this.$validStep = function() {
            return steps[selectedIndex] && steps[selectedIndex].isStepValid();
          };
          this.iconFor = function(index) {
            if (index < this.$index()) return 'crm-i fa-check';
            if (index === this.$index()) return 'crm-i fa-angle-double-right';
            return '';
          };
          this.isSelectable = function(step) {
            if (step.selected) return false;
            return this.$validStep();
          };

          /*** @param Object step the $scope of the step */
          this.select = function(step) {
            angular.forEach(steps, function(otherStep, otherKey) {
              otherStep.selected = (otherStep === step);
              if (otherStep === step && maxVisited < otherKey) maxVisited = otherKey;
            });
            selectedIndex = findIndex();
          };
          /*** @param Object step the $scope of the step */
          this.add = function(step) {
            if (steps.length === 0) {
              step.selected = true;
              selectedIndex = 0;
            }
            steps.push(step);
            steps.sort(function(a,b){
              return a.crmUiWizardStep - b.crmUiWizardStep;
            });
            selectedIndex = findIndex();
          };
          this.remove = function(step) {
            var key = null;
            angular.forEach(steps, function(otherStep, otherKey) {
              if (otherStep === step) key = otherKey;
            });
            if (key !== null) {
              steps.splice(key, 1);
            }
          };
          this.goto = function(index) {
            if (index < 0) index = 0;
            if (index >= steps.length) index = steps.length-1;
            this.select(steps[index]);
          };
          this.previous = function() { this.goto(this.$index()-1); };
          this.next = function() { this.goto(this.$index()+1); };
          if ($scope.crmUiWizard) {
            $parse($scope.crmUiWizard).assign($scope.$parent, this);
          }
        },
        link: function (scope, element, attrs) {
          scope.ts = CRM.ts(null);

          element.find('.crm-wizard-buttons button[ng-click^=crmUiWizardCtrl]').click(function () {
            var topOfWizard = element.offset().top;
            var heightOfMenu = $('#civicrm-menu').height() || 0;

            $('html')
              .stop()
              .animate({scrollTop: topOfWizard - heightOfMenu}, 1000);
          });
        }
      };
    })
    .directive('crmUiWizardButtons', function() {
      return {
        require: '^crmUiWizard',
        restrict: 'EA',
        scope: {},
        template: '<span ng-transclude></span>',
        transclude: true,
        link: function (scope, element, attrs, crmUiWizardCtrl) {
          var realButtonsEl = $(element).closest('.crm-wizard').find('.crm-wizard-buttons');
          $(element).appendTo(realButtonsEl);
        }
      };
    })
    .directive('crmIcon', function() {
      return {
        restrict: 'EA',
        link: function (scope, element, attrs) {
          if (element.is('[crm-ui-tab]')) {
            return;
          }
          if (attrs.crmIcon) {
            if (attrs.crmIcon.substring(0,3) == 'fa-') {
              $(element).prepend('<i class="crm-i ' + attrs.crmIcon + '" aria-hidden="true"></i> ');
            }
            else {
              $(element).prepend('<span class="icon ui-icon-' + attrs.crmIcon + '"></span> ');
            }
          }
          if ($(element).is('button:not(.btn)')) {
            $(element).addClass('crm-button');
          }
        }
      };
    })
    .directive('crmUiWizardStep', function() {
      var nextWeight = 1;
      return {
        require: ['^crmUiWizard', 'form'],
        restrict: 'EA',
        scope: {
          crmTitle: '@', // expression, evaluates to a printable string
          crmUiWizardStep: '@', // int, a weight which determines the ordering of the steps
          crmUiWizardStepClass: '@' // string, A list of classes that will be added to the template
        },
        template: '<div class="crm-wizard-step {{crmUiWizardStepClass}}" ng-show="selected" ng-transclude/></div>',
        transclude: true,
        link: function (scope, element, attrs, ctrls) {
          var crmUiWizardCtrl = ctrls[0], form = ctrls[1];
          if (scope.crmUiWizardStep) {
            scope.crmUiWizardStep = parseInt(scope.crmUiWizardStep);
          } else {
            scope.crmUiWizardStep = nextWeight++;
          }
          scope.isStepValid = function() {
            return form.$valid;
          };
          crmUiWizardCtrl.add(scope);
          scope.$on('$destroy', function(){
            crmUiWizardCtrl.remove(scope);
          });
        }
      };
    })
    .directive('crmConfirm', function ($compile, $rootScope, $templateRequest, $q) {
      var defaultFuncs = {
        'disable': function (options) {
          return {
            message: ts('Are you sure you want to disable this?'),
            options: {no: ts('Cancel'), yes: ts('Disable')},
            width: 300,
            title: ts('Disable %1?', {
              1: options.obj.title || options.obj.label || options.obj.name || ts('the record')
            })
          };
        },
        'revert': function (options) {
          return {
            message: ts('Are you sure you want to revert this?'),
            options: {no: ts('Cancel'), yes: ts('Revert')},
            width: 300,
            title: ts('Revert %1?', {
              1: options.obj.title || options.obj.label || options.obj.name || ts('the record')
            })
          };
        },
        'delete': function (options) {
          return {
            message: ts('Are you sure you want to delete this?'),
            options: {no: ts('Cancel'), yes: ts('Delete')},
            width: 300,
            title: ts('Delete %1?', {
              1: options.obj.title || options.obj.label || options.obj.name || ts('the record')
            })
          };
        }
      };
      var confirmCount = 0;
      return {
        link: function (scope, element, attrs) {
          $(element).click(function () {
            var options = scope.$eval(attrs.crmConfirm);
            if (attrs.title && !options.title) {
              options.title = attrs.title;
            }
            var defaults = (options.type) ? defaultFuncs[options.type](options) : {};

            var tpl = null, stubId = null;
            if (!options.message) {
              if (options.templateUrl) {
                tpl = $templateRequest(options.templateUrl);
              }
              else if (options.template) {
                tpl = options.template;
              }
              if (tpl) {
                stubId = 'crmUiConfirm_' + (++confirmCount);
                options.message = '<div id="' + stubId + '"></div>';
              }
            }

            if (options.confirmed) {
              scope.$apply(attrs.onYes);
              return;
            }

            CRM.confirm(_.extend(defaults, options))
              .on('crmConfirm:yes', function() { scope.$apply(attrs.onYes); })
              .on('crmConfirm:no', function() { scope.$apply(attrs.onNo); });

            if (tpl && stubId) {
              $q.when(tpl, function(html) {
                var scope = options.scope || $rootScope.$new();
                if (options.export) {
                  angular.extend(scope, options.export);
                }
                var linker = $compile(html);
                $('#' + stubId).append($(linker(scope)));
              });
            }
          });
        }
      };
    })
    .directive('crmPageTitle', function($timeout) {
      return {
        scope: {
          crmDocumentTitle: '='
        },
        link: function(scope, $el, attrs) {
          function update() {
            $timeout(function() {
              var newPageTitleHTML = $el.html().trim(),
                newDocumentTitle = scope.crmDocumentTitle || $el.text(),
                dialog = $el.closest('.ui-dialog-content');
              if (dialog.length) {
                dialog.dialog('option', 'title', newDocumentTitle);
                $el.hide();
              } else {
                document.title = $('title').text().replace(documentTitle, newDocumentTitle);
                [].forEach.call(document.querySelectorAll('h1:not(.crm-container h1), .crm-page-title-wrapper>h1'), h1 => {
                  if (h1.classList.contains('crm-page-title') || h1.innerHTML.trim() === pageTitleHTML) {
                    h1.classList.add('crm-page-title');
                    h1.innerHTML = newPageTitleHTML;
                    $el.hide();
                  }
                });
                pageTitleHTML = newPageTitleHTML;
                documentTitle = newDocumentTitle;
              }
            });
          }

          scope.$watch(function() {return scope.crmDocumentTitle + $el.html();}, update);
        }
      };
    })
    .directive("crmUiEditable", function() {
      return {
        restrict: "A",
        require: "ngModel",
        scope: {
          defaultValue: '='
        },
        link: function(scope, element, attrs, ngModel) {
          var ts = CRM.ts();

          function read() {
            var htmlVal = element.text();
            if (!htmlVal) {
              htmlVal = scope.defaultValue || '';
              element.text(htmlVal);
            }
            ngModel.$setViewValue(htmlVal);
          }

          ngModel.$render = function() {
            element.text(ngModel.$viewValue || scope.defaultValue || '');
          };
          element.on('keydown', function(e) {
            if (e.which === 13) {
              e.preventDefault();
              element.blur();
            }
            if (e.which === 27) {
              element.text(ngModel.$viewValue || scope.defaultValue || '');
              element.blur();
            }
          });

          element.on("blur change", function() {
            scope.$apply(read);
          });

          element.attr('contenteditable', 'true');
        }
      };
    })
    .directive('crmUiIconPicker', function($timeout) {
      return {
        restrict: 'A',
        require: '?ngModel', // Soft require ngModel
        controller: function($element, $scope, $attrs) {
          CRM.loadScript(CRM.config.resourceBase + 'js/jquery/jquery.crmIconPicker.js').then(function() {
            $timeout(function() {
              $element.crmIconPicker();
              if ($attrs.ngModel) {
                $scope.$watch($attrs.ngModel, function(newValue) {
                  if (newValue !== undefined) {
                    $element.val(newValue).trigger('change');
                  }
                });
              }
            });
          });
        }
      };
    })
    .factory('formatForSelect2', function() {
      return function(input, key, label, extra) {
        return _.transform(input, function(result, item) {
          var formatted = {id: item[key], text: item[label]};
          if (extra) {
            _.merge(formatted, _.pick(item, extra));
          }
          result.push(formatted);
        }, []);
      };
    })

    .run(function($rootScope, $location) {
      $rootScope.goto = function(path) {
        $location.path(path);
      };
    });


angular.module('crmUtil', CRM.angRequires('crmUtil'));
  angular.module('crmUtil').factory('crmApi', function($q) {
    var crmApi = function(entity, action, params, message) {
      var deferred = $q.defer();
      var p;
      var backend = crmApi.backend || CRM.api3;
      if (params && params.body_html) {
        params.body_html = params.body_html.replace(/([\u2028]|[\u2029])/g, '\n');
      }
      if (_.isObject(entity)) {
        /*jshint -W061 */
        p = backend(eval('('+angular.toJson(entity)+')'), action);
      } else {
        /*jshint -W061 */
        p = backend(entity, action, eval('('+angular.toJson(params)+')'), message);
      }
      p.then(
        function(result) {
          if (result.is_error) {
            deferred.reject(result);
          } else {
            deferred.resolve(result);
          }
        },
        function(error) {
          deferred.reject(error);
        }
      );
      return deferred.promise;
    };
    crmApi.backend = null;
    crmApi.val = function(value) {
      var d = $.Deferred();
      d.resolve(value);
      return d.promise();
    };
    return crmApi;
  });
  angular.module('crmUtil').factory('crmMetadata', function($q, crmApi) {
    function convertOptionsToMap(options) {
      var result = {};
      angular.forEach(options, function(o) {
        result[o.key] = o.value;
      });
      return result;
    }

    var cache = {}; // cache[entityName+'::'+action][fieldName].title
    var deferreds = {}; // deferreds[cacheKey].push($q.defer())
    var crmMetadata = {
      getField: function getField(entity, field) {
        return $q.when(crmMetadata.getFields(entity)).then(function(fields){
          return fields[field];
        });
      },
      getFields: function getFields(entity) {
        var action = '', cacheKey;
        if (_.isArray(entity)) {
          action = entity[1];
          entity = entity[0];
          cacheKey = entity + '::' + action;
        } else {
          cacheKey = entity;
        }

        if (_.isObject(cache[cacheKey])) {
          return cache[cacheKey];
        }

        var needFetch = _.isEmpty(deferreds[cacheKey]);
        deferreds[cacheKey] = deferreds[cacheKey] || [];
        var deferred = $q.defer();
        deferreds[cacheKey].push(deferred);

        if (needFetch) {
          crmApi(entity, 'getfields', {action: action, sequential: 1, options: {get_options: 'all'}})
            .then(
            function(fields) {
              cache[cacheKey] = _.indexBy(fields.values, 'name');
              angular.forEach(cache[cacheKey],function (field){
                if (field.options) {
                  field.optionsMap = convertOptionsToMap(field.options);
                }
              });
              angular.forEach(deferreds[cacheKey], function(dfr) {
                dfr.resolve(cache[cacheKey]);
              });
              delete deferreds[cacheKey];
            },
            function() {
              cache[cacheKey] = {}; // cache nack
              angular.forEach(deferreds[cacheKey], function(dfr) {
                dfr.reject();
              });
              delete deferreds[cacheKey];
            }
          );
        }

        return deferred.promise;
      }
    };

    return crmMetadata;
  });
  angular.module('crmUtil').factory('crmBlocker', function() {
    return function() {
      var blocks = 0;
      var result = function(promise) {
        blocks++;
        return promise.finally(function() {
          blocks--;
        });
      };
      result.check = function() {
        return blocks > 0;
      };
      return result;
    };
  });

  angular.module('crmUtil').factory('crmLegacy', function() {
    return CRM;
  });
  angular.module('crmUtil').factory('crmLog', function(){
    var level = 0;
    var write = console.log;
    function indent() {
      var s = '>';
      for (var i = 0; i < level; i++) s = s + '  ';
      return s;
    }
    var crmLog = {
      log: function(msg, vars) {
        write(indent() + msg, vars);
      },
      wrap: function(label, f) {
        return function(){
          level++;
          crmLog.log(label + ": start", arguments);
          var r;
          try {
            r = f.apply(this, arguments);
          } finally {
            crmLog.log(label + ": end");
            level--;
          }
          return r;
        };
      }
    };
    return crmLog;
  });

  angular.module('crmUtil').factory('crmNavigator', ['$window', function($window) {
    return {
      redirect: function(path) {
        $window.location.href = path;
      }
    };
  }]);
  angular.module('crmUtil').factory('crmQueue', function($q) {
    return function crmQueue(worker) {
      var queue = [];
      function next() {
        var task = queue[0];
        worker.apply(null, task.a).then(
          function onOk(data) {
            queue.shift();
            task.dfr.resolve(data);
            if (queue.length > 0) next();
          },
          function onErr(err) {
            queue.shift();
            task.dfr.reject(err);
            if (queue.length > 0) next();
          }
        );
      }
      function enqueue() {
        var dfr = $q.defer();
        queue.push({a: arguments, dfr: dfr});
        if (queue.length === 1) {
          next();
        }
        return dfr.promise;
      }
      return enqueue;
    };
  });
  angular.module('crmUtil').factory('crmStatus', function($q){
    return function(options, aPromise){
      if (aPromise) {
        return CRM.toAPromise($q, CRM.status(options, CRM.toJqPromise(aPromise)));
      } else {
        return CRM.toAPromise($q, CRM.status(options));
      }
    };
  });
  angular.module('crmUtil').factory('crmWatcher', function(){
    return function() {
      var unwatches = {}, watchFactories = {}, suspends = {};
      this.setup = function(name, newWatchFactory) {
        watchFactories[name] = newWatchFactory;
        unwatches[name] = watchFactories[name]();
        suspends[name] = 0;
        return this;
      };
      this.suspend = function(name, f) {
        suspends[name]++;
        this.teardown(name);
        var r;
        try {
          r = f.apply(this, []);
        } finally {
          if (suspends[name] === 1) {
            unwatches[name] = watchFactories[name]();
            if (!angular.isArray(unwatches[name])) {
              unwatches[name] = [unwatches[name]];
            }
          }
          suspends[name]--;
        }
        return r;
      };

      this.teardown = function(name) {
        if (!unwatches[name]) return;
        _.each(unwatches[name], function(unwatch){
          unwatch();
        });
        delete unwatches[name];
      };

      return this;
    };
  });
  angular.module('crmUtil').factory('crmThrottle', function($q) {
    var pending = [],
      executing = [];
    return function(func) {
      var deferred = $q.defer();

      function checkResult(result, success) {
        _.pull(executing, func);
        if (_.includes(pending, func)) {
          runNext();
        } else if (success) {
          deferred.resolve(result);
        } else {
          deferred.reject(result);
        }
      }

      function runNext() {
        executing.push(func);
        _.pull(pending, func);
        func().then(function(result) {
          checkResult(result, true);
        }, function(result) {
          checkResult(result, false);
        });
      }

      if (!_.includes(executing, func)) {
        runNext();
      } else if (!_.includes(pending, func)) {
        pending.push(func);
      }
      return deferred.promise;
    };
  });

  angular.module('crmUtil').factory('crmLoadScript', function($q) {
    return function(url) {
      var deferred = $q.defer();

      CRM.loadScript(url).done(function() {
        deferred.resolve(true);
      });

      return deferred.promise;
    };
  });

})(angular, CRM.$, CRM._);
