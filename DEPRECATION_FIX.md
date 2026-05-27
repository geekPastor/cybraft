# Fix for voku/portable-ascii Deprecated Parameter

## Problem

PHP 8.4 generates a deprecation warning:

```
Deprecated: voku\helper\ASCII::to_ascii(): Implicitly marking parameter $replace_single_chars_only 
as nullable is deprecated, the explicit nullable type must be used instead
```

This occurs in `vendor/voku/portable-ascii/src/voku/helper/ASCII.php` on line 801.

## Root Cause

The `$replace_single_chars_only` parameter has a default value (`= false`) but its type is declared as `bool` instead of `?bool`. PHP 8.4 requires explicit nullable types when a parameter with a non-nullable type has a default value.

## Solution

Modified the function signature in `ASCII.php` line 801:

```diff
- bool $replace_single_chars_only = false
+ ?bool $replace_single_chars_only = false
```

This allows the parameter to accept either a `bool` or `null` value, which is required by PHP 8.4.

## Implementation

1. **Direct Fix** (`vendor/voku/portable-ascii/src/voku/helper/ASCII.php`):
   - Changed parameter type to `?bool`

2. **Auto-patch Script** (`scripts/fix-portable-ascii.php`):
   - Automatically applies the fix when dependencies are installed
   - Runs via composer post-autoload-dump hook

3. **Patch File** (`patches/voku-portable-ascii-nullable-param.patch`):
   - Git-compatible patch for reference

## Files Changed

- `vendor/voku/portable-ascii/src/voku/helper/ASCII.php` - Type declaration fix
- `composer.json` - Added post-autoload-dump script
- `scripts/fix-portable-ascii.php` - Automatic fix script
- `patches/voku-portable-ascii-nullable-param.patch` - Reference patch file

## Verification

After applying the fix, the deprecation warning should no longer appear when:
- Running tests
- Starting the development server  
- Loading any page that uses vcard functionality

To verify: `php artisan serve` and check that no "Deprecated" messages appear at the top of pages.
