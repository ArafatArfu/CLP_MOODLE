/*
 * Frontend-only interactions.
 * Replace these placeholders with real report/export logic during backend integration.
 */
(() => {
  'use strict';

  document.querySelectorAll('[data-report-format]').forEach((button) => {
    button.addEventListener('click', () => {
      const format = button.dataset.reportFormat;
      window.alert(`Demo only: ${format.toUpperCase()} report download is not connected.`);
    });
  });

  const photoButton = document.querySelector('.more-photo-card');
  if (photoButton) {
    photoButton.addEventListener('click', () => {
      window.alert('Demo only: the remaining school photo gallery is not connected.');
    });
  }
})();
