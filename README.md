# WordPress + Foundation Columns Nav Menu
A WP walker to support a footer menu where top-level menu items are laid out as columns in Foundation's Float Grid.

Load the Walker in `functions.php` or in a plugin, then add the menu to your template file as such:

```php
$args = [
  'theme_location'   => 'footer-navigation',
  'container'        => 'div',
  'container_class'  => "menu-{$menu->slug}-container columns small-6 medium-3 large-2",
  'menu_class'       => 'footer-menu',
  'walker'           => new \Theme_Name\Foundation\Walker_Nav_Menu_Footer,
];
wp_nav_menu( $args );
```

The nav menu will need to be placed inside of a `row` element, which is excluded from the walker to accommodate items outside of the menu that you might want in the same row. This will produce the following layout, often used in footers:

```
Top Level Item 1    Top Level Item 2    Top Level Item 3
--------            --------            --------
Child item 1        Child item 1        Child item 1
Child item 2        Child item 2        Child item 2
Child item 3        Child item 3        Child item 3
```

You can easily modify the column layouts to use the XY grid or take up different numbers of grid columns -- just make sure to modify the classes in both the walker and the `wp_nav_menu` function.
