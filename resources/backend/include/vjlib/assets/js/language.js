 google.load("elements", "1", {packages: "transliteration"});
 
 function onLoad() {
     var options = {
         sourceLanguage:
             google.elements.transliteration.LanguageCode.ENGLISH,
         destinationLanguage:
             [google.elements.transliteration.LanguageCode.HINDI],
         shortcutKey: 'ctrl+g',
         transliterationEnabled: true
     };

     // Create an instance on TransliterationControl with the required
     // options.
     var control =
         new google.elements.transliteration.TransliterationControl(options);

     // Enable transliteration in the textbox with id
     // 'transliterateTextarea'.
     var elements = document.getElementsByClassName('language_hi');
     control.makeTransliteratable(elements);
     
    // control.makeTransliteratable(['transliterateTextarea']);
 }
   
 
 google.setOnLoadCallback(onLoad);