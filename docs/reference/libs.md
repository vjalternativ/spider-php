# Libraries reference

Classes under `libs/`. Each file declares one class; several extend the shared
`lib_singleton` or `lib_database` bases.

## Core libraries

| File | Class | Purpose |
| --- | --- | --- |
| `libs/lib_array.php` | `lib_array` | Array traversal and transformation helpers. |
| `libs/lib_bootstrap.php` | `lib_bootstrap` | Bootstrap assets and UI helpers. |
| `libs/lib_cli.php` | `lib_cli` | CLI and installer command handling. |
| `libs/lib_common.php` | `lib_common` | Shared bootstrap: configuration and common initialisation. |
| `libs/lib_config.php` | `lib_config` | Singleton configuration registry used across the framework. |
| `libs/lib_csv.php` | `lib_csv` | CSV import/export. |
| `libs/lib_curl.php` | `lib_curl` | cURL-based HTTP requests. |
| `libs/lib_currency.php` | `lib_currency` | Currency conversion and formatting. |
| `libs/lib_current_user.php` | `lib_current_user` | Access to the authenticated user. |
| `libs/lib_database.php` | `lib_database` (abstract) | Database abstraction base for drivers. |
| `libs/lib_datawrapper.php` | `lib_datawrapper` | Wrapper around query result data. |
| `libs/lib_entity.php` | `lib_entity` | Entity/record context used by the dispatcher. |
| `libs/lib_framework.php` | `lib_framework` | Front controller and dispatcher. |
| `libs/lib_loader.php` | `lib_loader` | Lazy library loading (`loadlib`, `getobj`, `loadFile`). |
| `libs/lib_logger.php` | `lib_logger` | Logging. |
| `libs/lib_modal.php` | `lib_modal` | Modal dialog helpers. |
| `libs/lib_mysqli.php` | `lib_mysqli` | MySQL driver. |
| `libs/lib_paginate.php` | `lib_paginate` | Pagination. |
| `libs/lib_postgres.php` | `lib_postgres` | PostgreSQL driver. |
| `libs/lib_seo.php` | `lib_seo` | SEO parameters, URL aliases and path parsing. |
| `libs/lib_session.php` | `lib_session` | Session handling. |
| `libs/lib_singleton.php` | `lib_singleton` (abstract) | Base class for singleton libraries. |
| `libs/lib_smarty.php` | `lib_smarty` | Smarty template integration. |
| `libs/lib_timezone.php` | `lib_timezone` | Timezone conversion helpers. |
| `libs/lib_util.php` | `lib_util` | General utilities, including `loadAvailableFile()` used by the dispatcher. |
| `libs/lib_xml.php` | `lib_xml` | XML generation/parsing. |

## HTML helpers

| File | Class | Purpose |
| --- | --- | --- |
| `libs/html/core/HTMLElement.php` | `HTMLElement` | Base HTML element. |
| `libs/html/core/HTMLElementDual.php` | `HTMLElementDual` | Element that wraps a second element. |
| `libs/html/core/HTMLH4.php` | `HTMLH4` | Heading element. |
| `libs/html/core/HTMLImg.php` | `HTMLImg` | Image element. |
| `libs/html/core/HTMLSpan.php` | `HTMLSpan` | Span element. |
| `libs/html/table/HTMLTable.php` | `HTMLTable` | Table builder. |
| `libs/html/table/HTMLTableRow.php` | `HTMLTableRow` | Table row. |
| `libs/html/table/HTMLTableCell.php` | `HTMLTableCell` | Table cell. |
| `libs/html/table/HTMLImgTableCell.php` | `HTMLImgTableCell` | Table cell containing an image. |

## Report helpers

| File | Class | Purpose |
| --- | --- | --- |
| `libs/htmlreport/HTMLReport.php` | `HTMLReport` | Top-level HTML report. |
| `libs/htmlreport/ReportSection.php` | `ReportSection` | Section within a report. |
| `libs/htmlreport/ReportTable.php` | `ReportTable` | Table within a report. |
| `libs/htmlreport/ReportRow.php` | `ReportRow` | Report table row. |
| `libs/htmlreport/ReportElement.php` | `ReportElement` | Report content element. |

`libs/htmlreport/registrationForm.tpl` is the template used by the registration report.

## Scalable data table

| File | Class/interface | Purpose |
| --- | --- | --- |
| `libs/scalable_data_table/IScalableDataTable.php` | `IScalableDataTable` | Contract for scalable tables. |
| `libs/scalable_data_table/AScalableDataTable.php` | `AScalableDataTable` | Abstract base implementation. |
| `libs/scalable_data_table/InternalScalableDataTable.php` | `InternalScalableDataTable` | Internal-backed table. |
| `libs/scalable_data_table/SpiderScalableDataTable.php` | `SpiderScalableDataTable` | Framework-backed table. |

## Assets

`libs/assets/js/` contains the JavaScript helpers shipped with the libraries
(`lib_html2pdf.js`, `lib_iframe.js`, `lib_desktopnotification.js`).

TODO: document the public methods of the most-used libraries (`lib_database`,
`lib_smarty`, `lib_seo`, `lib_cli`) with signatures.
