# CLP Center Profile Frontend

Frontend-only implementation of the supplied **Chittagong Model High School CLC** design reference.

## Included

- HTML5 semantic layout
- Bootstrap 5.1.1 bundled locally
- Bootstrap Icons bundled locally
- Responsive desktop, laptop, tablet, and mobile layout
- Static/dummy content only
- No API, database, backend, or validation logic
- Backend-ready follow-up fields with meaningful `id`, `name`, and `label` values

## New fields added

The following fields are placed directly below **Last Visit Date** in the right sidebar:

- `follow_up_over_phone`
- `last_follow_up_date`

## Run

Open `index.html` directly in a modern browser, or open the folder with VS Code Live Server.

No build step or package installation is required.

## Folder structure

```text
clp-center-ui/
├── index.html
├── css/
│   ├── style.css
│   └── vendor/
│       ├── bootstrap.min.css
│       └── bootstrap-icons.css
├── js/
│   ├── script.js
│   └── vendor/
│       └── bootstrap.bundle.min.js
├── assets/
│   ├── images/
│   ├── icons/
│   └── fonts/
└── README.md
```

## Backend integration notes

The follow-up form is intentionally simple:

```html
<form class="follow-up-form" action="#" method="post" novalidate>
```

During backend integration:

1. Replace `action="#"` with the save/update endpoint.
2. Add the framework CSRF token.
3. Populate `value` attributes from the server.
4. Add server-side validation and error messages.
5. Keep the current input IDs and names so frontend labels remain correctly connected.

## Reference asset

`assets/images/reference-design.png` is included only as the original visual reference supplied for this task.
