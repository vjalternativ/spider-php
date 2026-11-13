# Beans reference

`beans/` holds small runtime-state objects. `RuntimeBean` persists its data as JSON, so
subclasses can keep state that must survive between requests without a database table.

| File | Class | Purpose |
| --- | --- | --- |
| `beans/RuntimeBean.php` | `RuntimeBean` (abstract) | Base JSON-backed state: `readJson()`, `load()`, `write()`, `setPath()`. |
| `beans/TempRuntime.php` | `TempRuntime` | Temporary-file state: `moveToTemp()`, `writeToTemp()`, `getTempFilePath()`. |
| `beans/ModuleRuntime.php` | `ModuleRuntime` | Module registry: `init()`, `getModuleList()`, `getPath()`, `write()`. |
| `beans/DBField.php` | `DBField` | Schema field descriptor: name, data type, length, default, index and owning table. |
| `beans/RowProcessHook.php` | `RowProcessHook` (abstract) | Row-processing hook state: enum list, process sequence, first-row marker and dimension indexer. |

## Notes

- `RuntimeBean` subclasses call `setPath()` and then `write()`; the base class serialises
  the object to JSON at that path.
- `ModuleRuntime` is used by `lib_framework::initModules()` to enumerate modules.
- `DBField` is used by schema/database tooling to describe columns.

TODO: document the JSON file locations used by each runtime bean.
