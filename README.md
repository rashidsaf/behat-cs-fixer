## Implementation

   Command endpoint takes the files list as arguments and fix the formatting. All configurations can be modified.
  Each step code style can be defined independently based on keywords (`And`, `Then`, `Scenario` etc).

### Code style
- All step keywords and tables (_symbol_:`|`) are right-aligned (_Except_ `Scenario`, `Feature`, `Background` _and_ `Examples`).
- All extra spaces inside table cells are deleted
- Table column width is determined by the longest cell in that column.

### Known issues:
- Extra newlines are not deleted.
- Doesn't check newline end the end of the file.
- Doesn't remove extra spaces inside steps other than table row steps.
- Commented table step makes the table to be recognized as 2 separate tables.

### Usage:
  
    behat-fixer /path/to/test1.feature /path/to/test2.feature ...
    
### Dependencies
- PHP >= 7.1.0