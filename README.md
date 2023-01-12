WHY NOT A GIF HERE? TO SET THE MODE.

# Tech Island

This island is perfect for techers, hackers and everything in between.

# Hotel Silicon-Vali

A dreamy irl web hotel with endless coding and internet.

# Instructions

If your project requires some installation or similar, please inform your user 'bout it. For instance, if you want a more decent indentation of your .php files, you could edit [.editorconfig]('/.editorconfig').

# Code review

1. functions.php:12 + 86 - i funktionerna som returnerar booleans hade jag även sparat ett error meddelande i en array.

2. Filstruktur: En views folder för header och footer.

3. index.php:24 + 28 - När du echoar ut i html skulle du kunna skriva <?= istället för <?php echo .
4. VALIdation.php:28-60 - För att göra det lite mer läsbart i nestade if-satser skulle man kunna vända på kriterierna i IF-satserna så att de returnar false. Ex if (!checkDateAvailability()).
   .
5. style.css - . Dela upp stylingen i t.ex global, fonts variables eller liknande för att göra det mer läsbart och lättarbetat.

6. functions.php:106 - $visitors är lite otydligt namn på variabel.

7. style.css:189 - align-items: start; verkar överflödigt här.

8. style.css 125 + 137 - text-align: start är default och verkar överflödigt här.

9. style.css:44 - width 100% är överflödigt, förmodligen pga att det är cover på background-image.

10. style.css:124 - margin-top: 0 är överflödigt, den får det redan från \* {
    margin: 0;
    }
