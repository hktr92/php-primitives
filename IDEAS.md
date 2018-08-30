Architecture:
- Separate methods that calls `mb_*` into a `ProcessorInterface` object and reate a "standard" fallback class

Features:
- Implement classes for Numbers (int, float)
- Implement class for Array
- Implement more String methods:
    - `isUpperCase()`
    - `isLowerCase()`
    - `isTitleCase()`
    - `max()` / `min()`
    - `strip()`, `replace()`