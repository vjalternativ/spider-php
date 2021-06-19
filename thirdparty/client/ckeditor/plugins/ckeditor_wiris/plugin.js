(function() {
  function n(i) {
    if (t[i]) {
      return t[i].exports;
    }
    var r = (t[i] = { i: i, l: false, exports: {} });
    e[i].call(r.exports, r, r.exports, n);
    r.l = true;
    return r.exports;
  }
  var e = [
    function(e) {
      e.exports = JSON.parse(
        '{"ar":{"latex":"LaTeX","cancel":"\u0625\u0644\u063A\u0627\u0621","accept":"\u0625\u062F\u0631\u0627\u062C","manual":"\u0627\u0644\u062F\u0644\u064A\u0644","insert_math":"\u0625\u062F\u0631\u0627\u062C \u0635\u064A\u063A\u0629 \u0631\u064A\u0627\u0636\u064A\u0629 - MathType","insert_chem":"\u0625\u062F\u0631\u0627\u062C \u0635\u064A\u063A\u0629 \u0643\u064A\u0645\u064A\u0627\u0626\u064A\u0629 - ChemType","minimize":"\u062A\u0635\u063A\u064A\u0631","maximize":"\u062A\u0643\u0628\u064A\u0631","fullscreen":"\u0645\u0644\u0621 \u0627\u0644\u0634\u0627\u0634\u0629","exit_fullscreen":"\u0627\u0644\u062E\u0631\u0648\u062C \u0645\u0646 \u0645\u0644\u0621 \u0627\u0644\u0634\u0627\u0634\u0629","close":"\u0625\u063A\u0644\u0627\u0642","mathtype":"MathType","title_modalwindow":"\u0646\u0627\u0641\u0630\u0629 MathType \u0645\u0634\u0631\u0648\u0637\u0629","close_modal_warning":"\u0647\u0644 \u062A\u0631\u064A\u062F \u0627\u0644\u0645\u063A\u0627\u062F\u0631\u0629 \u0628\u0627\u0644\u062A\u0623\u0643\u064A\u062F\u061F \u0633\u062A\u064F\u0641\u0642\u062F \u0627\u0644\u062A\u063A\u064A\u064A\u0631\u0627\u062A \u0627\u0644\u062A\u064A \u0623\u062C\u0631\u064A\u062A\u0647\u0627.","latex_name_label":"\u0635\u064A\u063A\u0629 Latex","browser_no_compatible":"\u0627\u0644\u0645\u0633\u062A\u0639\u0631\u0636 \u063A\u064A\u0631 \u0645\u062A\u0648\u0627\u0641\u0642 \u0645\u0639 \u062A\u0642\u0646\u064A\u0629 AJAX. \u0627\u0644\u0631\u062C\u0627\u0621 \u0627\u0633\u062A\u062E\u062F\u0627\u0645 \u0623\u062D\u062F\u062B \u0625\u0635\u062F\u0627\u0631 \u0645\u0646 Mozilla Firefox.","error_convert_accessibility":"\u062D\u062F\u062B \u062E\u0637\u0623 \u0623\u062B\u0646\u0627\u0621 \u0627\u0644\u062A\u062D\u0648\u064A\u0644 \u0645\u0646 MathML \u0625\u0644\u0649 \u0646\u0635 \u0642\u0627\u0628\u0644 \u0644\u0644\u0627\u0633\u062A\u062E\u062F\u0627\u0645.","exception_cross_site":"\u0627\u0644\u0628\u0631\u0645\u062C\u0629 \u0627\u0644\u0646\u0635\u064A\u0629 \u0644\u0644\u0645\u0648\u0627\u0642\u0639 \u0627\u0644\u0645\u0634\u062A\u0631\u0643\u0629 \u0645\u0633\u0645\u0648\u062D \u0628\u0647\u0627 \u0644\u0640\xA0HTTP \u0641\u0642\u0637.","exception_high_surrogate":"\u0627\u0644\u0645\u0631\u0643\u0651\u0628 \u0627\u0644\u0645\u0631\u062A\u0641\u0639 \u063A\u064A\u0631 \u0645\u062A\u0628\u0648\u0639 \u0628\u0645\u0631\u0643\u0651\u0628 \u0645\u0646\u062E\u0641\u0636 \u0641\u064A fixedCharCodeAt()\u200E","exception_string_length":"\u0633\u0644\u0633\u0644\u0629 \u063A\u064A\u0631 \u0635\u0627\u0644\u062D\u0629. \u064A\u062C\u0628 \u0623\u0646 \u064A\u0643\u0648\u0646 \u0627\u0644\u0637\u0648\u0644 \u0645\u0646 \u0645\u0636\u0627\u0639\u0641\u0627\u062A \u0627\u0644\u0639\u062F\u062F 4","exception_key_nonobject":"Object.keys \u0645\u0633\u062A\u062F\u0639\u0627\u0629 \u0639\u0644\u0649 \u063A\u064A\u0631 \u0643\u0627\u0626\u0646","exception_null_or_undefined":" \u0647\u0630\u0627 \u0641\u0627\u0631\u063A \u0623\u0648 \u063A\u064A\u0631 \u0645\u062D\u062F\u062F","exception_not_function":" \u0644\u064A\u0633\u062A \u062F\u0627\u0644\u0629","exception_invalid_date_format":"\u062A\u0646\u0633\u064A\u0642 \u062A\u0627\u0631\u064A\u062E \u063A\u064A\u0631 \u0635\u0627\u0644\u062D: ","exception_casting":"\u0644\u0627 \u064A\u0645\u0643\u0646 \u0627\u0644\u0635\u064A\u0627\u063A\u0629 ","exception_casting_to":" \u0625\u0644\u0649 "},"ca":{"latex":"LaTeX","cancel":"Cancel\xB7lar","accept":"Inserir","manual":"Manual","insert_math":"Inserir f\xF3rmula matem\xE0tica - MathType","insert_chem":"Inserir f\xF3rmula qu\xEDmica - ChemType","minimize":"Minimitza","maximize":"Maximitza","fullscreen":"Pantalla completa","exit_fullscreen":"Sortir de la pantalla complera","close":"Tanca","mathtype":"MathType","title_modalwindow":" Finestra modal de MathType","close_modal_warning":"N\'est\xE0s segur que vols sortir? Es perdran els canvis que has fet.","latex_name_label":"F\xF3rmula en Latex","browser_no_compatible":"El teu navegador no \xE9s compatible amb AJAX. Si us plau, usa la darrera versi\xF3 de Mozilla Firefox.","error_convert_accessibility":"Error en convertir de MathML a text accessible.","exception_cross_site":"Els scripts de llocs creuats nom\xE9s estan permesos per HTTP.","exception_high_surrogate":"Subrogat alt no seguit de subrogat baix a fixedCharCodeAt()","exception_string_length":"Cadena inv\xE0lida. La longitud ha de ser un m\xFAltiple de 4","exception_key_nonobject":"Object.keys anomenat a non-object","exception_null_or_undefined":" aix\xF2 \xE9s null o no definit","exception_not_function":" no \xE9s una funci\xF3","exception_invalid_date_format":"Format de data inv\xE0lid : ","exception_casting":"No es pot emetre ","exception_casting_to":" a "},"cs":{"latex":"LaTeX","cancel":"Storno","accept":"Vlo\u017Eit","manual":"P\u0159\xEDru\u010Dka","insert_math":"Vlo\u017Eit matematick\xFD vzorec - MathType","insert_chem":"Vlo\u017Een\xED chemick\xE9ho vzorce \u2013 ChemType","minimize":"Minimalizovat","maximize":"Maximalizovat","fullscreen":"Cel\xE1 obrazovka","exit_fullscreen":"Opustit re\u017Eim cel\xE9 obrazovky","close":"Zav\u0159\xEDt","mathtype":"MathType","title_modalwindow":"Mod\xE1ln\xED okno MathType","close_modal_warning":"Opravdu chcete okno zav\u0159\xEDt? Proveden\xE9 zm\u011Bny budou ztraceny.","latex_name_label":"Vzorec v\xA0LaTeXu","browser_no_compatible":"V\xE1\u0161 prohl\xED\u017Ee\u010D nepodporuje technologii AJAX. Pou\u017Eijte nejnov\u011Bj\u0161\xED verzi prohl\xED\u017Ee\u010De Mozilla Firefox.","error_convert_accessibility":"P\u0159i p\u0159evodu k\xF3du MathML na \u010Diteln\xFD text do\u0161lo k\xA0chyb\u011B.","exception_cross_site":"Skriptov\xE1n\xED mezi v\xEDce servery je povoleno jen v\xA0HTTP.","exception_high_surrogate":"Ve funkci fixedCharCodeAt() nen\xE1sleduje po prvn\xED \u010D\xE1sti k\xF3du znaku druh\xE1 \u010D\xE1st","exception_string_length":"Neplatn\xFD \u0159et\u011Bzec. D\xE9lka mus\xED b\xFDt n\xE1sobkem 4.","exception_key_nonobject":"Funkce Object.keys byla pou\u017Eita pro prvek, kter\xFD nen\xED objektem","exception_null_or_undefined":" hodnota je null nebo nen\xED definovan\xE1","exception_not_function":" nen\xED funkce","exception_invalid_date_format":"Neplatn\xFD form\xE1t data: ","exception_casting":"Nelze p\u0159etypovat ","exception_casting_to":" na "},"da":{"latex":"LaTeX","cancel":"Annuller","accept":"Inds\xE6t","manual":"Brugervejledning","insert_math":"Inds\xE6t matematisk formel - MathType","insert_chem":"Inds\xE6t en kemisk formel - ChemType","minimize":"Minimer","maximize":"Maksimer","fullscreen":"Fuld sk\xE6rm","exit_fullscreen":"Afslut Fuld sk\xE6rm","close":"Luk","mathtype":"MathType","title_modalwindow":"MathType-modalvindue","close_modal_warning":"Er du sikker p\xE5, du vil lukke? Dine \xE6ndringer g\xE5r tabt.","latex_name_label":"LaTex-formel","browser_no_compatible":"Din browser er ikke kompatibel med AJAX-teknologi. Brug den nyeste version af Mozilla Firefox.","error_convert_accessibility":"Fejl under konvertering fra MathML til tilg\xE6ngelig tekst.","exception_cross_site":"Scripts p\xE5 tv\xE6rs af websteder er kun tilladt for HTTP.","exception_high_surrogate":"Et h\xF8jt erstatningstegn er ikke fulgt af et lavt erstatningstegn i fixedCharCodeAt()","exception_string_length":"Ugyldig streng. L\xE6ngden skal v\xE6re et multiplum af 4","exception_key_nonobject":"Object.keys kaldet ved ikke-objekt","exception_null_or_undefined":" dette er nul eller ikke defineret","exception_not_function":" er ikke en funktion","exception_invalid_date_format":"Ugyldigt datoformat: ","exception_casting":"Kan ikke beregne ","exception_casting_to":" til "},"de":{"latex":"LaTeX","cancel":"Abbrechen","accept":"Einf\xFCgen","manual":"Handbuch","insert_math":"Mathematische Formel einf\xFCgen - MathType","insert_chem":"Eine chemische Formel einf\xFCgen \u2013 ChemType","minimize":"Verkleinern","maximize":"Vergr\xF6\xDFern","fullscreen":"Vollbild","exit_fullscreen":"Vollbild schlie\xDFen","close":"Schlie\xDFen","mathtype":"MathType","title_modalwindow":"Modales MathType-Fenster","close_modal_warning":"Bist du sicher, dass du das Programm verlassen willst? Alle vorgenommenen \xC4nderungen gehen damit verloren.","latex_name_label":"Latex-Formel","browser_no_compatible":"Dein Browser ist nicht mit der AJAX-Technologie kompatibel. Verwende bitte die neueste Version von Mozilla Firefox.","error_convert_accessibility":"Fehler beim Konvertieren von MathML in barrierefreien Text.","exception_cross_site":"Cross-Site-Scripting ist nur bei HTTP zul\xE4ssig.","exception_high_surrogate":"Hoher Ersatz bei bei festerZeichenkodierungbei() nicht von niedrigem Ersatz befolgt.","exception_string_length":"Ung\xFCltige Zeichenfolge. L\xE4nge muss ein Vielfaches von 4 sein.","exception_key_nonobject":"Object.keys wurde f\xFCr ein Nicht-Objekt aufgerufen.","exception_null_or_undefined":" Das ist Null oder nicht definiert.","exception_not_function":" ist keine Funktion","exception_invalid_date_format":"Ung\xFCltiges Datumsformat: ","exception_casting":"Umwandlung nicht m\xF6glich ","exception_casting_to":" zu "},"el":{"latex":"LaTeX","cancel":"\u0386\u03BA\u03C5\u03C1\u03BF","accept":"\u0395\u03B9\u03C3\u03B1\u03B3\u03C9\u03B3\u03AE","manual":"\u03A7\u03B5\u03B9\u03C1\u03BF\u03BA\u03AF\u03BD\u03B7\u03C4\u03B1","insert_math":"\u0395\u03B9\u03C3\u03B1\u03B3\u03C9\u03B3\u03AE \u03BC\u03B1\u03B8\u03B7\u03BC\u03B1\u03C4\u03B9\u03BA\u03BF\u03CD \u03C4\u03CD\u03C0\u03BF\u03C5 - MathType","insert_chem":"\u0395\u03B9\u03C3\u03B1\u03B3\u03C9\u03B3\u03AE \u03C7\u03B7\u03BC\u03B9\u03BA\u03BF\u03CD \u03C4\u03CD\u03C0\u03BF\u03C5 - ChemType","minimize":"\u0395\u03BB\u03B1\u03C7\u03B9\u03C3\u03C4\u03BF\u03C0\u03BF\u03AF\u03B7\u03C3\u03B7","maximize":"\u039C\u03B5\u03B3\u03B9\u03C3\u03C4\u03BF\u03C0\u03BF\u03AF\u03B7\u03C3\u03B7","fullscreen":"\u03A0\u03BB\u03AE\u03C1\u03B7\u03C2 \u03BF\u03B8\u03CC\u03BD\u03B7","exit_fullscreen":"\u0388\u03BE\u03BF\u03B4\u03BF\u03C2 \u03B1\u03C0\u03CC \u03C0\u03BB\u03AE\u03C1\u03B7 \u03BF\u03B8\u03CC\u03BD\u03B7","close":"\u039A\u03BB\u03B5\u03AF\u03C3\u03B9\u03BC\u03BF","mathtype":"MathType","title_modalwindow":"\u03A4\u03C1\u03BF\u03C0\u03B9\u03BA\u03CC \u03C0\u03B1\u03C1\u03AC\u03B8\u03C5\u03C1\u03BF MathType","close_modal_warning":"\u0395\u03C0\u03B9\u03B8\u03C5\u03BC\u03B5\u03AF\u03C4\u03B5 \u03C3\u03AF\u03B3\u03BF\u03C5\u03C1\u03B1 \u03B1\u03C0\u03BF\u03C7\u03CE\u03C1\u03B7\u03C3\u03B7; \u0398\u03B1 \u03C7\u03B1\u03B8\u03BF\u03CD\u03BD \u03BF\u03B9 \u03B1\u03BB\u03BB\u03B1\u03B3\u03AD\u03C2 \u03C0\u03BF\u03C5 \u03AD\u03C7\u03B5\u03C4\u03B5 \u03BA\u03AC\u03BD\u03B5\u03B9.","latex_name_label":"\u03A4\u03CD\u03C0\u03BF\u03C2 LaTeX","browser_no_compatible":"\u03A4\u03BF \u03C0\u03C1\u03CC\u03B3\u03C1\u03B1\u03BC\u03BC\u03B1 \u03C0\u03B5\u03C1\u03B9\u03AE\u03B3\u03B7\u03C3\u03AE\u03C2 \u03C3\u03B1\u03C2 \u03B4\u03B5\u03BD \u03B5\u03AF\u03BD\u03B1\u03B9 \u03C3\u03C5\u03BC\u03B2\u03B1\u03C4\u03CC \u03BC\u03B5 \u03C4\u03B7\u03BD \u03C4\u03B5\u03C7\u03BD\u03BF\u03BB\u03BF\u03B3\u03AF\u03B1 AJAX. \u03A7\u03C1\u03B7\u03C3\u03B9\u03BC\u03BF\u03C0\u03BF\u03B9\u03AE\u03C3\u03C4\u03B5 \u03C4\u03B7\u03BD \u03C0\u03B9\u03BF \u03C0\u03C1\u03CC\u03C3\u03C6\u03B1\u03C4\u03B7 \u03AD\u03BA\u03B4\u03BF\u03C3\u03B7 \u03C4\u03BF\u03C5 Mozilla Firefox.","error_convert_accessibility":"\u03A3\u03C6\u03AC\u03BB\u03BC\u03B1 \u03BA\u03B1\u03C4\u03AC \u03C4\u03B7 \u03BC\u03B5\u03C4\u03B1\u03C4\u03C1\u03BF\u03C0\u03AE \u03B1\u03C0\u03CC MathML \u03C3\u03B5 \u03C0\u03C1\u03BF\u03C3\u03B2\u03AC\u03C3\u03B9\u03BC\u03BF \u03BA\u03B5\u03AF\u03BC\u03B5\u03BD\u03BF.","exception_cross_site":"\u03A4\u03BF XSS (Cross site scripting) \u03B5\u03C0\u03B9\u03C4\u03C1\u03AD\u03C0\u03B5\u03C4\u03B1\u03B9 \u03BC\u03CC\u03BD\u03BF \u03B3\u03B9\u03B1 HTTP.","exception_high_surrogate":"\u03A4\u03BF \u03C5\u03C8\u03B7\u03BB\u03CC \u03C5\u03C0\u03BF\u03BA\u03B1\u03C4\u03AC\u03C3\u03C4\u03B1\u03C4\u03BF \u03B4\u03B5\u03BD \u03B1\u03BA\u03BF\u03BB\u03BF\u03C5\u03B8\u03B5\u03AF\u03C4\u03B1\u03B9 \u03B1\u03C0\u03CC \u03C7\u03B1\u03BC\u03B7\u03BB\u03CC \u03C5\u03C0\u03BF\u03BA\u03B1\u03C4\u03AC\u03C3\u03C4\u03B1\u03C4\u03BF \u03C3\u03C4\u03BF fixedCharCodeAt()","exception_string_length":"\u039C\u03B7 \u03AD\u03B3\u03BA\u03C5\u03C1\u03B7 \u03C3\u03C5\u03BC\u03B2\u03BF\u03BB\u03BF\u03C3\u03B5\u03B9\u03C1\u03AC. \u03A4\u03BF \u03BC\u03AE\u03BA\u03BF\u03C2 \u03C0\u03C1\u03AD\u03C0\u03B5\u03B9 \u03BD\u03B1 \u03B5\u03AF\u03BD\u03B1\u03B9 \u03C0\u03BF\u03BB\u03BB\u03B1\u03C0\u03BB\u03AC\u03C3\u03B9\u03BF \u03C4\u03BF\u03C5 4","exception_key_nonobject":"\u0388\u03B3\u03B9\u03BD\u03B5 \u03BA\u03BB\u03AE\u03C3\u03B7 \u03C4\u03BF\u03C5 Object.keys \u03C3\u03B5 \u03BC\u03B7 \u03B1\u03BD\u03C4\u03B9\u03BA\u03B5\u03AF\u03BC\u03B5\u03BD\u03BF","exception_null_or_undefined":" \u03B1\u03C5\u03C4\u03CC \u03B5\u03AF\u03BD\u03B1\u03B9 \u03BC\u03B7\u03B4\u03B5\u03BD\u03B9\u03BA\u03CC \u03AE \u03B4\u03B5\u03BD \u03AD\u03C7\u03B5\u03B9 \u03BF\u03C1\u03B9\u03C3\u03C4\u03B5\u03AF","exception_not_function":" \u03B4\u03B5\u03BD \u03B5\u03AF\u03BD\u03B1\u03B9 \u03C3\u03C5\u03BD\u03AC\u03C1\u03C4\u03B7\u03C3\u03B7","exception_invalid_date_format":"\u039C\u03B7 \u03AD\u03B3\u03BA\u03C5\u03C1\u03B7 \u03BC\u03BF\u03C1\u03C6\u03AE \u03B7\u03BC\u03B5\u03C1\u03BF\u03BC\u03B7\u03BD\u03AF\u03B1\u03C2: ","exception_casting":"\u0394\u03B5\u03BD \u03B5\u03AF\u03BD\u03B1\u03B9 \u03B4\u03C5\u03BD\u03B1\u03C4\u03AE \u03B7 \u03BC\u03B5\u03C4\u03B1\u03C4\u03C1\u03BF\u03C0\u03AE ","exception_casting_to":" \u03C3\u03B5 "},"en":{"latex":"LaTeX","cancel":"Cancel","accept":"Insert","manual":"Manual","insert_math":"Insert a math equation - MathType","insert_chem":"Insert a chemistry formula - ChemType","minimize":"Minimize","maximize":"Maximize","fullscreen":"Full-screen","exit_fullscreen":"Exit full-screen","close":"Close","mathtype":"MathType","title_modalwindow":"MathType modal window","close_modal_warning":"Are you sure you want to leave? The changes you made will be lost.","latex_name_label":"Latex Formula","browser_no_compatible":"Your browser is not compatible with AJAX technology. Please, use the latest version of Mozilla Firefox.","error_convert_accessibility":"Error converting from MathML to accessible text.","exception_cross_site":"Cross site scripting is only allowed for HTTP.","exception_high_surrogate":"High surrogate not followed by low surrogate in fixedCharCodeAt()","exception_string_length":"Invalid string. Length must be a multiple of 4","exception_key_nonobject":"Object.keys called on non-object","exception_null_or_undefined":" this is null or not defined","exception_not_function":" is not a function","exception_invalid_date_format":"Invalid date format : ","exception_casting":"Cannot cast ","exception_casting_to":" to "},"es":{"latex":"LaTeX","cancel":"Cancelar","accept":"Insertar","manual":"Manual","insert_math":"Insertar f\xF3rmula matem\xE1tica - MathType","insert_chem":"Insertar f\xF3rmula qu\xEDmica - ChemType","minimize":"Minimizar","maximize":"Maximizar","fullscreen":"Pantalla completa","exit_fullscreen":"Salir de pantalla completa","close":"Cerrar","mathtype":"MathType","title_modalwindow":"Ventana modal de MathType","close_modal_warning":"Seguro que quieres cerrar? Los cambios que has hecho se perder\xE1n","latex_name_label":"Formula en Latex","browser_no_compatible":"Tu navegador no es complatible con AJAX. Por favor, usa la \xFAltima version de Mozilla Firefox.","error_convert_accessibility":"Error conviertiendo una f\xF3rmula MathML a texto accesible.","exception_cross_site":"Cross site scripting solo est\xE1 permitido para HTTP.","exception_high_surrogate":"Subrogado alto no seguido por subrogado bajo en fixedCharCodeAt()","exception_string_length":"Cadena no v\xE1lida. La longitud debe ser m\xFAltiplo de 4","exception_key_nonobject":"Object.keys called on non-object","exception_null_or_undefined":" esto es null o no definido","exception_not_function":" no es una funci\xF3n","exception_invalid_date_format":"Formato de fecha inv\xE1lido: ","exception_casting":"No se puede emitir","exception_casting_to":" a "},"et":{"latex":"LaTeX","cancel":"Loobu","accept":"Lisa","manual":"K\xE4siraamat","insert_math":"Lisa matemaatiline valem \u2013 WIRIS","insert_chem":"Lisa keemiline valem \u2013 ChemType","minimize":"Minimeeri","maximize":"Maksimeeri","fullscreen":"T\xE4iskuva","exit_fullscreen":"V\xE4lju t\xE4iskuvalt","close":"Sule","mathtype":"MathType","title_modalwindow":"MathType\'i modaalaken","close_modal_warning":"Kas soovite kindlasti lahkuda? Tehtud muudatused l\xE4hevad kaduma.","latex_name_label":"Latexi valem","browser_no_compatible":"Teie brauser ei \xFChildu AJAXi tehnoloogiaga. Palun kasutage Mozilla Firefoxi uusimat versiooni.","error_convert_accessibility":"T\xF5rge teisendamisel MathML-ist muudetavaks tekstiks.","exception_cross_site":"Ristskriptimine on lubatud ainult HTTP kasutamisel.","exception_high_surrogate":"Funktsioonis fixedCharCodeAt() ei j\xE4rgne k\xF5rgemale asendusliikmele madalam asendusliige.","exception_string_length":"Vigane string. Pikkus peab olema 4 kordne.","exception_key_nonobject":"Protseduur Object.keys kutsuti mitteobjekti korral.","exception_null_or_undefined":" see on null v\xF5i m\xE4\xE4ramata","exception_not_function":" ei ole funktsioon","exception_invalid_date_format":"Sobimatu kuup\xE4eva kuju: ","exception_casting":"Esitamine ei \xF5nnestu ","exception_casting_to":" \u2013 "},"eu":{"latex":"LaTeX","cancel":"Ezeztatu","accept":"Txertatu","manual":"Gida","insert_math":"Txertatu matematikako formula - MathType","insert_chem":"Txertatu formula kimiko bat - ChemType","minimize":"Ikonotu","maximize":"Maximizatu","fullscreen":"Pantaila osoa","exit_fullscreen":"Irten pantaila osotik","close":"Itxi","mathtype":"MathType","title_modalwindow":"MathType leiho modala","close_modal_warning":"Ziur irten nahi duzula? Egiten dituzun aldaketak galdu egingo dira.","latex_name_label":"LaTex Formula","browser_no_compatible":"Zure arakatzailea ez da bateragarria AJAX teknologiarekin. Erabili Mozilla Firefoxen azken bertsioa.","error_convert_accessibility":"Errorea MathMLtik testu irisgarrira bihurtzean.","exception_cross_site":"Gune arteko scriptak HTTPrako soilik onartzen dira.","exception_high_surrogate":"Ordezko baxuak ez dio ordezko altuari jarraitzen, hemen: fixedCharCodeAt()","exception_string_length":"Kate baliogabea. Luzerak 4ren multiploa izan behar du","exception_key_nonobject":"Object.keys deitu zaio objektua ez den zerbaiti","exception_null_or_undefined":" nulua edo definitu gabea da","exception_not_function":" ez da funtzio bat","exception_invalid_date_format":"Data-formatu baliogabea : ","exception_casting":"Ezin da igorri ","exception_casting_to":" honi "},"fi":{"latex":"LaTeX","cancel":"Peruuta","accept":"Lis\xE4\xE4","manual":"Manual","insert_math":"Liit\xE4 matemaattinen kaava - MathType","insert_chem":"Lis\xE4\xE4 kemian kaava - ChemType","minimize":"Pienenn\xE4","maximize":"Suurenna","fullscreen":"Koko ruutu","exit_fullscreen":"Poistu koko ruudun tilasta","close":"Sulje","mathtype":"MathType","title_modalwindow":"MathTypen modaalinen ikkuna","close_modal_warning":"Oletko varma, ett\xE4 haluat poistua? Menet\xE4t tekem\xE4si muutokset.","latex_name_label":"Latex-kaava","browser_no_compatible":"Selaimesi ei tue AJAX-tekniikkaa. Ole hyv\xE4 ja k\xE4yt\xE4 uusinta Firefox-versiota.","error_convert_accessibility":"Virhe muunnettaessa MathML:st\xE4 tekstiksi.","exception_cross_site":"Cross site scripting sallitaan vain HTTP:ll\xE4.","exception_high_surrogate":"fixedCharCodeAt(): yl\xE4sijaismerkki\xE4 ei seurannut alasijaismerkki","exception_string_length":"Ep\xE4kelpo merkkijono. Pituuden on oltava 4:n kerrannainen","exception_key_nonobject":"Object.keys kutsui muuta kuin oliota","exception_null_or_undefined":" t\xE4m\xE4 on null tai ei m\xE4\xE4ritelty","exception_not_function":" ei ole funktio","exception_invalid_date_format":"Virheellinen p\xE4iv\xE4m\xE4\xE4r\xE4muoto : ","exception_casting":"Ei voida muuntaa tyyppi\xE4 ","exception_casting_to":" tyyppiin "},"fr":{"latex":"LaTeX","cancel":"Annuler","accept":"Ins\xE9rer","manual":"Manuel","insert_math":"Ins\xE9rer une formule math\xE9matique - MathType","insert_chem":"Ins\xE9rer une formule chimique - ChemType","minimize":"Minimiser","maximize":"Maximiser","fullscreen":"Plein \xE9cran","exit_fullscreen":"Quitter le plein \xE9cran","close":"Fermer","mathtype":"MathType","title_modalwindow":"Fen\xEAtre modale MathType","close_modal_warning":"Confirmez-vous vouloir fermer\xA0? Les changements effectu\xE9s seront perdus.","latex_name_label":"Formule LaTeX","browser_no_compatible":"Votre navigateur n\u2019est pas compatible avec la technologie AJAX. Veuillez utiliser la derni\xE8re version de Mozilla Firefox.","error_convert_accessibility":"Une erreur de conversion du format MathML en texte accessible est survenue.","exception_cross_site":"Le cross-site scripting n\u2019est autoris\xE9 que pour HTTP.","exception_high_surrogate":"Substitut \xE9lev\xE9 non suivi d\u2019un substitut inf\xE9rieur dans fixedCharCodeAt()","exception_string_length":"Cha\xEEne non valide. Longueur limit\xE9e aux multiples de\xA04","exception_key_nonobject":"Object.keys appel\xE9 sur un non-objet","exception_null_or_undefined":" nul ou non d\xE9fini","exception_not_function":" n\u2019est pas une fonction","exception_invalid_date_format":"Format de date non valide\xA0: ","exception_casting":"Impossible de convertir ","exception_casting_to":" sur "},"gl":{"latex":"LaTeX","cancel":"Cancelar","accept":"Inserir","manual":"Manual","insert_math":"Inserir unha f\xF3rmula matem\xE1tica - MathType","insert_chem":"Inserir unha f\xF3rmula qu\xEDmica - ChemType","minimize":"Minimizar","maximize":"Maximizar","fullscreen":"Pantalla completa","exit_fullscreen":"Sa\xEDr da pantalla completa","close":"Pechar","mathtype":"MathType","title_modalwindow":"Vent\xE1 modal de MathType","close_modal_warning":"Seguro que quere sa\xEDr? Perderanse os cambios realizados.","latex_name_label":"F\xF3rmula Latex","browser_no_compatible":"O seu explorador non \xE9 compatible coa tecnolox\xEDa AJAX. Use a versi\xF3n m\xE1is recente de Mozilla Firefox.","error_convert_accessibility":"Erro ao converter de MathML a texto accesible.","exception_cross_site":"Os scripts de sitios s\xF3 se permiten para HTTP.","exception_high_surrogate":"Suplente superior non seguido por suplente inferior en fixedCharCodeAt()","exception_string_length":"Cadea non v\xE1lida. A lonxitude debe ser un m\xFAltiplo de 4","exception_key_nonobject":"Claves de obxecto chamadas en non obxecto","exception_null_or_undefined":" nulo ou non definido","exception_not_function":" non \xE9 unha funci\xF3n","exception_invalid_date_format":"Formato de data non v\xE1lido: ","exception_casting":"Non se pode converter ","exception_casting_to":" a "},"he":{"latex":"LaTeX","cancel":"\u05D1\u05D9\u05D8\u05D5\u05DC","accept":"\u05D4\u05D5\u05E1\u05E3","manual":"\u05DE\u05D3\u05E8\u05D9\u05DA","insert_math":"\u05D4\u05D5\u05E1\u05E3 \u05E0\u05D5\u05E1\u05D7\u05D4 \u05DE\u05EA\u05DE\u05D8\u05D9\u05EA - MathType","insert_chem":"\u05D4\u05D5\u05E1\u05E4\u05EA \u05DB\u05EA\u05D9\u05D1\u05D4 \u05DB\u05D9\u05DE\u05D9\u05EA - ChemType","minimize":"\u05DE\u05D6\u05E2\u05E8\u05D9","maximize":"\u05DE\u05E8\u05D1\u05D9","fullscreen":"\u05DE\u05E1\u05DA \u05DE\u05DC\u05D0","exit_fullscreen":"\u05D9\u05E6\u05D9\u05D0\u05D4 \u05DE\u05DE\u05E6\u05D1 \u05DE\u05E1\u05DA \u05DE\u05DC\u05D0","close":"\u05E1\u05D2\u05D9\u05E8\u05D4","mathtype":"MathType","title_modalwindow":"\u05D7\u05DC\u05D5\u05DF \u05DE\u05D5\u05D3\u05D0\u05DC\u05D9 \u05E9\u05DC MathType","close_modal_warning":"\u05D4\u05D0\u05DD \u05DC\u05E6\u05D0\u05EA? \u05E9\u05D9\u05E0\u05D5\u05D9\u05D9\u05DD \u05D0\u05E9\u05E8 \u05D1\u05D5\u05E6\u05E2\u05D5 \u05D9\u05DE\u05D7\u05E7\u05D5.","latex_name_label":"\u05E0\u05D5\u05E1\u05D7\u05EA Latex","browser_no_compatible":"\u05D4\u05D3\u05E4\u05D3\u05E4\u05DF \u05E9\u05DC\u05DA \u05D0\u05D9\u05E0\u05D5 \u05EA\u05D5\u05D0\u05DD \u05DC\u05D8\u05DB\u05E0\u05D5\u05DC\u05D5\u05D2\u05D9\u05D9\u05EA AJAX. \u05D9\u05E9 \u05DC\u05D4\u05E9\u05EA\u05DE\u05E9 \u05D1\u05D2\u05E8\u05E1\u05D4 \u05D4\u05E2\u05D3\u05DB\u05E0\u05D9\u05EA \u05D1\u05D9\u05D5\u05EA\u05E8 \u05E9\u05DC Mozilla Firefox.","error_convert_accessibility":"\u05E9\u05D2\u05D9\u05D0\u05D4 \u05D1\u05D4\u05DE\u05E8\u05D4 \u05DE-MathML \u05DC\u05D8\u05E7\u05E1\u05D8 \u05E0\u05D2\u05D9\u05E9.","exception_cross_site":"\u05E1\u05E7\u05E8\u05D9\u05E4\u05D8\u05D9\u05E0\u05D2 \u05D7\u05D5\u05E6\u05D4-\u05D0\u05EA\u05E8\u05D9\u05DD \u05DE\u05D5\u05E8\u05E9\u05D4 \u05E2\u05D1\u05D5\u05E8 HTTP \u05D1\u05DC\u05D1\u05D3.","exception_high_surrogate":"\u05E2\u05E8\u05DA \u05DE\u05DE\u05DC\u05D0 \u05DE\u05E7\u05D5\u05DD \u05D2\u05D1\u05D5\u05D4 \u05D0\u05D9\u05E0\u05D5 \u05DE\u05D5\u05E4\u05D9\u05E2 \u05D0\u05D7\u05E8\u05D9 \u05E2\u05E8\u05DA \u05DE\u05DE\u05DC\u05D0 \u05DE\u05E7\u05D5\u05DD \u05E0\u05DE\u05D5\u05DA \u05D1-fixedCharCodeAt()\u200E","exception_string_length":"\u05DE\u05D7\u05E8\u05D5\u05D6\u05EA \u05DC\u05D0 \u05D7\u05D5\u05E7\u05D9\u05EA. \u05D4\u05D0\u05D5\u05E8\u05DA \u05D7\u05D9\u05D9\u05D1 \u05DC\u05D4\u05D9\u05D5\u05EA \u05DB\u05E4\u05D5\u05DC\u05D4 \u05E9\u05DC 4","exception_key_nonobject":"\u05D1\u05D5\u05E6\u05E2\u05D4 \u05E7\u05E8\u05D9\u05D0\u05D4 \u05D0\u05DC Object.keys \u05D1\u05E8\u05DB\u05D9\u05D1 \u05E9\u05D0\u05D9\u05E0\u05D5 \u05D0\u05D5\u05D1\u05D9\u05D9\u05E7\u05D8","exception_null_or_undefined":" \u05D4\u05D5\u05D0 Null \u05D0\u05D5 \u05DC\u05D0 \u05DE\u05D5\u05D2\u05D3\u05E8","exception_not_function":"\u05D0\u05D9\u05E0\u05E0\u05D4 \u05E4\u05D5\u05E0\u05E7\u05E6\u05D9\u05D4","exception_invalid_date_format":"\u05EA\u05E1\u05D3\u05D9\u05E8 \u05EA\u05D0\u05E8\u05D9\u05DA \u05D0\u05D9\u05E0\u05D5 \u05EA\u05E7\u05D9\u05DF : ","exception_casting":"\u05DC\u05D0 \u05E0\u05D9\u05EA\u05DF \u05DC\u05D4\u05DE\u05D9\u05E8 ","exception_casting_to":" \u05DC "},"hr":{"latex":"LaTeX","cancel":"Poni\u0161ti","accept":"Umetni","manual":"Priru\u010Dnik","insert_math":"Umetnite matemati\u010Dku formulu - MathType","insert_chem":"Umetnite kemijsku formulu - ChemType","minimize":"Minimiziraj","maximize":"Maksimiziraj","fullscreen":"Cijeli zaslon","exit_fullscreen":"Izlaz iz prikaza na cijelom zaslonu","close":"Zatvori","mathtype":"MathType","title_modalwindow":"MathType modalni prozor","close_modal_warning":"Sigurno \u017Eelite zatvoriti? Izgubit \u0107e se unesene promjene.","latex_name_label":"Latex formula","browser_no_compatible":"Va\u0161 preglednik nije kompatibilan s AJAX tehnologijom. Upotrijebite najnoviju verziju Mozilla Firefoxa.","error_convert_accessibility":"Pogre\u0161ka konverzije iz MathML-a u dostupni tekst.","exception_cross_site":"Skriptiranje na razli\u010Ditim web-mjestima dopu\u0161teno je samo za HTTP.","exception_high_surrogate":"Iza visoke zamjene ne slijedi niska zamjena u fixedCharCodeAt()","exception_string_length":"Neva\u017Ee\u0107i niz. Duljina mora biti vi\u0161ekratnik broja 4","exception_key_nonobject":"Object.keys pozvano na ne-objekt","exception_null_or_undefined":" ovo je nula ili nije definirano","exception_not_function":" nije funkcija","exception_invalid_date_format":"Neva\u017Ee\u0107i format datuma : ","exception_casting":"Ne mo\u017Ee se poslati ","exception_casting_to":" na "},"hu":{"latex":"LaTeX","cancel":"M\xE9gsem","accept":"Besz\xFAr\xE1s","manual":"K\xE9zik\xF6nyv","insert_math":"Matematikai k\xE9plet besz\xFAr\xE1sa - MathType","insert_chem":"K\xE9miai k\xE9pet beilleszt\xE9se - ChemType","minimize":"Kis m\xE9ret","maximize":"Nagy m\xE9ret","fullscreen":"Teljes k\xE9perny\u0151","exit_fullscreen":"Teljes k\xE9perny\u0151 elhagy\xE1sa","close":"Bez\xE1r\xE1s","mathtype":"MathType","title_modalwindow":"MathType mod\xE1lis ablak","close_modal_warning":"Biztosan kil\xE9p? A m\xF3dos\xEDt\xE1sok el fognak veszni.","latex_name_label":"Latex k\xE9plet","browser_no_compatible":"A b\xF6ng\xE9sz\u0151je nem kompatibilis az AJAX technol\xF3gi\xE1val. Haszn\xE1lja a Mozilla Firefox leg\xFAjabb verzi\xF3j\xE1t.","error_convert_accessibility":"Hiba l\xE9pett fel a MathML sz\xF6vegg\xE9 t\xF6rt\xE9n\u0151 konvert\xE1l\xE1sa sor\xE1n.","exception_cross_site":"Az oldalak k\xF6zti scriptel\xE9s csak HTTP eset\xE9n enged\xE9lyezett.","exception_high_surrogate":"A magas helyettes\xEDt\u0151 karaktert nem alacsony helyettes\xEDt\u0151 karakter k\xF6veti a fixedCharCodeAt() eset\xE9ben","exception_string_length":"\xC9rv\xE9nytelen karakterl\xE1nc. A hossznak a 4 t\xF6bbsz\xF6r\xF6s\xE9nek kell lennie","exception_key_nonobject":"Az Object.keys egy nem objektumra ker\xFClt megh\xEDv\xE1sra","exception_null_or_undefined":" null vagy nem defini\xE1lt","exception_not_function":" nem f\xFCggv\xE9ny","exception_invalid_date_format":"\xC9rv\xE9nytelen d\xE1tumform\xE1tum: ","exception_casting":"Nem alkalmazhat\xF3 ","exception_casting_to":" erre "},"id":{"latex":"LaTeX","cancel":"Membatalkan","accept":"Masukkan","manual":"Manual","insert_math":"Masukkan rumus matematika - MathType","insert_chem":"Masukkan rumus kimia - ChemType","minimize":"Minikan","maximize":"Perbesar","fullscreen":"Layar penuh","exit_fullscreen":"Keluar layar penuh","close":"Tutup","mathtype":"MathType","title_modalwindow":"Jendela modal MathType","close_modal_warning":"Anda yakin ingin keluar? Anda akan kehilangan perubahan yang Anda buat.","latex_name_label":"Rumus Latex","browser_no_compatible":"Penjelajah Anda tidak kompatibel dengan teknologi AJAX. Harap gunakan Mozilla Firefox versi terbaru.","error_convert_accessibility":"Kesalahan konversi dari MathML menjadi teks yang dapat diakses.","exception_cross_site":"Skrip lintas situs hanya diizinkan untuk HTTP.","exception_high_surrogate":"Pengganti tinggi tidak diikuti oleh pengganti rendah di fixedCharCodeAt()","exception_string_length":"String tidak valid. Panjang harus kelipatan 4","exception_key_nonobject":"Object.keys meminta nonobjek","exception_null_or_undefined":" ini tidak berlaku atau tidak didefinisikan","exception_not_function":" bukan sebuah fungsi","exception_invalid_date_format":"Format tanggal tidak valid : ","exception_casting":"Tidak dapat mentransmisikan ","exception_casting_to":" untuk "},"it":{"latex":"LaTeX","cancel":"Annulla","accept":"Inserisci","manual":"Manuale","insert_math":"Inserisci una formula matematica - MathType","insert_chem":"Inserisci una formula chimica - ChemType","minimize":"Riduci a icona","maximize":"Ingrandisci","fullscreen":"Schermo intero","exit_fullscreen":"Esci da schermo intero","close":"Chiudi","mathtype":"MathType","title_modalwindow":"Finestra modale di MathType","close_modal_warning":"Confermi di voler uscire? Le modifiche effettuate andranno perse.","latex_name_label":"Formula LaTeX","browser_no_compatible":"Il tuo browser non \xE8 compatibile con la tecnologia AJAX. Utilizza la versione pi\xF9 recente di Mozilla Firefox.","error_convert_accessibility":"Errore durante la conversione da MathML in testo accessibile.","exception_cross_site":"Lo scripting tra siti \xE8 consentito solo per HTTP.","exception_high_surrogate":"Surrogato alto non seguito da surrogato basso in fixedCharCodeAt()","exception_string_length":"Stringa non valida. La lunghezza deve essere un multiplo di 4","exception_key_nonobject":"Metodo Object.keys richiamato in un elemento non oggetto","exception_null_or_undefined":" questo \xE8 un valore null o non definito","exception_not_function":" non \xE8 una funzione","exception_invalid_date_format":"Formato di data non valido: ","exception_casting":"Impossibile eseguire il cast ","exception_casting_to":" a "},"ja":{"latex":"LaTeX","cancel":"\u30AD\u30E3\u30F3\u30BB\u30EB","accept":"\u633F\u5165","manual":"\u30DE\u30CB\u30E5\u30A2\u30EB","insert_math":"\u6570\u5F0F\u3092\u633F\u5165 - MathType","insert_chem":"\u5316\u5B66\u5F0F\u3092\u633F\u5165 - ChemType","minimize":"\u6700\u5C0F\u5316","maximize":"\u6700\u5927\u5316","fullscreen":"\u5168\u753B\u9762\u8868\u793A","exit_fullscreen":"\u5168\u753B\u9762\u8868\u793A\u3092\u89E3\u9664","close":"\u9589\u3058\u308B","mathtype":"MathType","title_modalwindow":"MathType \u30E2\u30FC\u30C9\u30A6\u30A3\u30F3\u30C9\u30A6","close_modal_warning":"\u3053\u306E\u30DA\u30FC\u30B8\u304B\u3089\u79FB\u52D5\u3057\u3066\u3082\u3088\u308D\u3057\u3044\u3067\u3059\u304B\uFF1F\u5909\u66F4\u5185\u5BB9\u306F\u5931\u308F\u308C\u307E\u3059\u3002","latex_name_label":"LaTeX \u6570\u5F0F","browser_no_compatible":"\u304A\u4F7F\u3044\u306E\u30D6\u30E9\u30A6\u30B6\u306F\u3001AJAX \u6280\u8853\u3068\u4E92\u63DB\u6027\u304C\u3042\u308A\u307E\u305B\u3093\u3002Mozilla Firefox \u306E\u6700\u65B0\u30D0\u30FC\u30B8\u30E7\u30F3\u3092\u3054\u4F7F\u7528\u304F\u3060\u3055\u3044\u3002","error_convert_accessibility":"MathML \u304B\u3089\u30A2\u30AF\u30BB\u30B7\u30D6\u30EB\u306A\u30C6\u30AD\u30B9\u30C8\u3078\u306E\u5909\u63DB\u4E2D\u306B\u30A8\u30E9\u30FC\u304C\u767A\u751F\u3057\u307E\u3057\u305F\u3002","exception_cross_site":"\u30AF\u30ED\u30B9\u30B5\u30A4\u30C8\u30B9\u30AF\u30EA\u30D7\u30C6\u30A3\u30F3\u30B0\u306F\u3001HTTP \u306E\u307F\u306B\u8A31\u53EF\u3055\u308C\u3066\u3044\u307E\u3059\u3002","exception_high_surrogate":"fixedCharCodeAt\uFF08\uFF09\u3067\u4E0A\u4F4D\u30B5\u30ED\u30B2\u30FC\u30C8\u306E\u5F8C\u306B\u4E0B\u4F4D\u30B5\u30ED\u30B2\u30FC\u30C8\u304C\u3042\u308A\u307E\u305B\u3093","exception_string_length":"\u7121\u52B9\u306A\u6587\u5B57\u5217\u3067\u3059\u3002\u9577\u3055\u306F4\u306E\u500D\u6570\u3067\u3042\u308B\u5FC5\u8981\u304C\u3042\u308A\u307E\u3059","exception_key_nonobject":"Object.keys \u304C\u975E\u30AA\u30D6\u30B8\u30A7\u30AF\u30C8\u3067\u547C\u3073\u51FA\u3055\u308C\u307E\u3057\u305F","exception_null_or_undefined":" null \u3067\u3042\u308B\u304B\u3001\u5B9A\u7FA9\u3055\u308C\u3066\u3044\u307E\u305B\u3093","exception_not_function":" \u306F\u95A2\u6570\u3067\u306F\u3042\u308A\u307E\u305B\u3093","exception_invalid_date_format":"\u7121\u52B9\u306A\u65E5\u4ED8\u5F62\u5F0F: ","exception_casting":"\u6B21\u306B\u30AD\u30E3\u30B9\u30C8 ","exception_casting_to":" \u3067\u304D\u307E\u305B\u3093 "},"ko":{"latex":"LaTeX","cancel":"\uCDE8\uC18C","accept":"\uC0BD\uC785","manual":"\uC124\uBA85\uC11C","insert_math":"\uC218\uD559 \uACF5\uC2DD \uC0BD\uC785 - MathType","insert_chem":"\uD654\uD559 \uACF5\uC2DD \uC785\uB825\uD558\uAE30 - ChemType","minimize":"\uCD5C\uC18C\uD654","maximize":"\uCD5C\uB300\uD654","fullscreen":"\uC804\uCCB4 \uD654\uBA74","exit_fullscreen":"\uC804\uCCB4 \uD654\uBA74 \uB098\uAC00\uAE30","close":"\uB2EB\uAE30","mathtype":"MathType","title_modalwindow":"MathType \uBAA8\uB2EC \uCC3D","close_modal_warning":"\uC815\uB9D0\uB85C \uB098\uAC00\uC2DC\uACA0\uC2B5\uB2C8\uAE4C? \uBCC0\uACBD \uC0AC\uD56D\uC774 \uC190\uC2E4\uB429\uB2C8\uB2E4.","latex_name_label":"Latex \uACF5\uC2DD","browser_no_compatible":"\uC0AC\uC6A9\uC790\uC758 \uBE0C\uB77C\uC6B0\uC800\uB294 AJAX \uAE30\uC220\uACFC \uD638\uD658\uB418\uC9C0 \uC54A\uC2B5\uB2C8\uB2E4. Mozilla Firefox \uCD5C\uC2E0 \uBC84\uC804\uC744 \uC0AC\uC6A9\uD558\uC2ED\uC2DC\uC624.","error_convert_accessibility":"MathML\uB85C\uBD80\uD130 \uC811\uADFC \uAC00\uB2A5\uD55C \uD14D\uC2A4\uD2B8\uB85C \uC624\uB958 \uBCC0\uD658.","exception_cross_site":"\uC0AC\uC774\uD2B8 \uAD50\uCC28 \uC2A4\uD06C\uB9BD\uD305\uC740 HTTP \uD658\uACBD\uC5D0\uC11C\uB9CC \uC0AC\uC6A9\uD560 \uC218 \uC788\uC2B5\uB2C8\uB2E4.","exception_high_surrogate":"fixedCharCodeAt()\uC5D0\uC11C\uB294 \uC0C1\uC704 \uC11C\uB7EC\uAC8C\uC774\uD2B8 \uB4A4\uC5D0 \uD558\uC704 \uC11C\uB7EC\uAC8C\uC774\uD2B8\uAC00 \uBD99\uC9C0 \uC54A\uC2B5\uB2C8\uB2E4","exception_string_length":"\uC720\uD6A8\uD558\uC9C0 \uC54A\uC740 \uC2A4\uD2B8\uB9C1\uC785\uB2C8\uB2E4. \uAE38\uC774\uB294 4\uC758 \uBC30\uC218\uC5EC\uC57C \uD569\uB2C8\uB2E4","exception_key_nonobject":"Object.keys\uAC00 non-object\uB97C \uC694\uCCAD\uD558\uC600\uC2B5\uB2C8\uB2E4","exception_null_or_undefined":" Null\uAC12\uC774\uAC70\uB098 \uC815\uC758\uB418\uC9C0 \uC54A\uC558\uC2B5\uB2C8\uB2E4","exception_not_function":" \uD568\uC218\uAC00 \uC544\uB2D9\uB2C8\uB2E4","exception_invalid_date_format":"\uC720\uD6A8\uD558\uC9C0 \uC54A\uC740 \uB0A0\uC9DC \uD3EC\uB9F7 : ","exception_casting":"\uCE90\uC2A4\uD305\uD560 \uC218 \uC5C6\uC2B5\uB2C8\uB2E4 ","exception_casting_to":" (\uC73C)\uB85C "},"nl":{"latex":"LaTeX","cancel":"Annuleren","insert_chem":"Een scheikundige formule invoegen - ChemType","minimize":"Minimaliseer","maximize":"Maximaliseer","fullscreen":"Schermvullend","exit_fullscreen":"Verlaat volledig scherm","close":"Sluit","mathtype":"MathType","title_modalwindow":"Modaal venster MathType","close_modal_warning":"Weet je zeker dat je de app wilt sluiten? De gemaakte wijzigingen gaan verloren.","latex_name_label":"LaTeX-formule","browser_no_compatible":"Je browser is niet compatibel met AJAX-technologie. Gebruik de meest recente versie van Mozilla Firefox.","error_convert_accessibility":"Fout bij conversie van MathML naar toegankelijke tekst.","exception_cross_site":"Cross-site scripting is alleen toegestaan voor HTTP.","exception_high_surrogate":"Hoog surrogaat niet gevolgd door laag surrogaat in fixedCharCodeAt()","exception_string_length":"Ongeldige tekenreeks. Lengte moet een veelvoud van 4 zijn","exception_key_nonobject":"Object.keys opgeroepen voor niet-object","exception_null_or_undefined":" dit is nul of niet gedefinieerd","exception_not_function":" is geen functie","exception_invalid_date_format":"Ongeldige datumnotatie: ","exception_casting":"Kan niet weergeven ","exception_casting_to":" op "},"no":{"latex":"LaTeX","cancel":"Avbryt","accept":"Set inn","manual":"H\xE5ndbok","insert_math":"Sett inn matematikkformel - MathType","insert_chem":"Set inn ein kjemisk formel \u2013 ChemType","minimize":"Minimer","maximize":"Maksimer","fullscreen":"Fullskjerm","exit_fullscreen":"Avslutt fullskjerm","close":"Lukk","mathtype":"MathType","title_modalwindow":"Modalt MathType-vindu","close_modal_warning":"Er du sikker p\xE5 at du vil g\xE5 ut? Endringane du har gjort, vil g\xE5 tapt.","latex_name_label":"LaTeX-formel","browser_no_compatible":"Nettlesaren er ikkje kompatibel med AJAX-teknologien. Bruk den nyaste versjonen av Mozilla Firefox.","error_convert_accessibility":"Feil under konvertering fr\xE5 MathML til tilgjengeleg tekst.","exception_cross_site":"Skripting p\xE5 tvers av nettstadar er bere tillaten med HTTP.","exception_high_surrogate":"H\xF8gt surrogat er ikkje etterf\xF8lgt av l\xE5gt surrogat i fixedCharCodeAt()","exception_string_length":"Ugyldig streng. Lengda m\xE5 vera deleleg p\xE5 4","exception_key_nonobject":"Object.keys kalla p\xE5 eit ikkje-objekt","exception_null_or_undefined":" dette er null eller ikkje definert","exception_not_function":" er ikkje ein funksjon","exception_invalid_date_format":"Ugyldig datoformat: ","exception_casting":"Kan ikkje bruka casting ","exception_casting_to":" til "},"nb":{"latex":"LaTeX","cancel":"Avbryt","accept":"Insert","manual":"H\xE5ndbok","insert_math":"Sett inn matematikkformel - MathType","insert_chem":"Sett inn en kjemisk formel \u2013 ChemType","minimize":"Minimer","maximize":"Maksimer","fullscreen":"Fullskjerm","exit_fullscreen":"Avslutt fullskjerm","close":"Lukk","mathtype":"MathType","title_modalwindow":"Modalt MathType-vindu","close_modal_warning":"Er du sikker p\xE5 at du vil g\xE5 ut? Endringene du har gjort, vil g\xE5 tapt.","latex_name_label":"LaTeX-formel","browser_no_compatible":"Nettleseren er ikke kompatibel med AJAX-teknologien. Bruk den nyeste versjonen av Mozilla Firefox.","error_convert_accessibility":"Feil under konvertering fra MathML til tilgjengelig tekst.","exception_cross_site":"Skripting p\xE5 tvers av nettsteder er bare tillatt med HTTP.","exception_high_surrogate":"H\xF8yt surrogat etterf\xF8lges ikke av lavt surrogat i fixedCharCodeAt()","exception_string_length":"Ugyldig streng. Lengden m\xE5 v\xE6re delelig p\xE5 4","exception_key_nonobject":"Object.keys kalte p\xE5 et ikke-objekt","exception_null_or_undefined":" dette er null eller ikke definert","exception_not_function":" er ikke en funksjon","exception_invalid_date_format":"Ugyldig datoformat: ","exception_casting":"Kan ikke bruke casting ","exception_casting_to":" til "},"nn":{"latex":"LaTeX","cancel":"Avbryt","accept":"Set inn","manual":"H\xE5ndbok","insert_math":"Sett inn matematikkformel - MathType","insert_chem":"Set inn ein kjemisk formel \u2013 ChemType","minimize":"Minimer","maximize":"Maksimer","fullscreen":"Fullskjerm","exit_fullscreen":"Avslutt fullskjerm","close":"Lukk","mathtype":"MathType","title_modalwindow":"Modalt MathType-vindu","close_modal_warning":"Er du sikker p\xE5 at du vil g\xE5 ut? Endringane du har gjort, vil g\xE5 tapt.","latex_name_label":"LaTeX-formel","browser_no_compatible":"Nettlesaren er ikkje kompatibel med AJAX-teknologien. Bruk den nyaste versjonen av Mozilla Firefox.","error_convert_accessibility":"Feil under konvertering fr\xE5 MathML til tilgjengeleg tekst.","exception_cross_site":"Skripting p\xE5 tvers av nettstadar er bere tillaten med HTTP.","exception_high_surrogate":"H\xF8gt surrogat er ikkje etterf\xF8lgt av l\xE5gt surrogat i fixedCharCodeAt()","exception_string_length":"Ugyldig streng. Lengda m\xE5 vera deleleg p\xE5 4","exception_key_nonobject":"Object.keys kalla p\xE5 eit ikkje-objekt","exception_null_or_undefined":" dette er null eller ikkje definert","exception_not_function":" er ikkje ein funksjon","exception_invalid_date_format":"Ugyldig datoformat: ","exception_casting":"Kan ikkje bruka casting ","exception_casting_to":" til "},"pl":{"latex":"LaTeX","cancel":"Anuluj","accept":"Wstaw","manual":"Instrukcja","insert_math":"Wstaw formu\u0142\u0119 matematyczn\u0105 - MathType","insert_chem":"Wstaw wz\xF3r chemiczny\xA0\u2014 ChemType","minimize":"Minimalizuj","maximize":"Maksymalizuj","fullscreen":"Pe\u0142ny ekran","exit_fullscreen":"Opu\u015B\u0107 tryb pe\u0142noekranowy","close":"Zamknij","mathtype":"MathType","title_modalwindow":"Okno modalne MathType","close_modal_warning":"Czy na pewno chcesz zamkn\u0105\u0107? Wprowadzone zmiany zostan\u0105 utracone.","latex_name_label":"Wz\xF3r Latex","browser_no_compatible":"Twoja przegl\u0105darka jest niezgodna z\xA0technologi\u0105 AJAX U\u017Cyj najnowszej wersji Mozilla Firefox.","error_convert_accessibility":"B\u0142\u0105d podczas konwertowania z\xA0formatu MathML na dost\u0119pny tekst.","exception_cross_site":"Krzy\u017Cowanie skrypt\xF3w witryny jest dozwolone tylko dla HTTP.","exception_high_surrogate":"Brak niskiego surogatu po wysokim surogacie w\xA0fixedCharCodeAt()","exception_string_length":"Niew\u0142a\u015Bciwy ci\u0105g znak\xF3w. D\u0142ugo\u015B\u0107 musi by\u0107 wielokrotno\u015Bci\u0105 liczby 4.","exception_key_nonobject":"Argumentem wywo\u0142anej funkcji Object.key nie jest obiekt.","exception_null_or_undefined":" jest zerowy lub niezdefiniowany","exception_not_function":" nie jest funkcj\u0105","exception_invalid_date_format":"Nieprawid\u0142owy format daty: ","exception_casting":"Nie mo\u017Cna rzutowa\u0107 ","exception_casting_to":" na "},"pt":{"latex":"LaTeX","cancel":"Cancelar","accept":"Inserir","manual":"Manual","insert_math":"Inserir f\xF3rmula matem\xE1tica - MathType","insert_chem":"Inserir uma f\xF3rmula qu\xEDmica - ChemType","minimize":"Minimizar","maximize":"Maximizar","fullscreen":"Ecr\xE3 completo","exit_fullscreen":"Sair do ecr\xE3 completo","close":"Fechar","mathtype":"MathType","title_modalwindow":"Janela modal do MathType","close_modal_warning":"Pretende sair? As altera\xE7\xF5es efetuadas ser\xE3o perdidas.","latex_name_label":"F\xF3rmula Latex","browser_no_compatible":"O seu navegador n\xE3o \xE9 compat\xEDvel com a tecnologia AJAX. Utilize a vers\xE3o mais recente do Mozilla Firefox.","error_convert_accessibility":"Erro ao converter de MathML para texto acess\xEDvel.","exception_cross_site":"O processamento de scripts em v\xE1rios sites s\xF3 \xE9 permitido para HTTP.","exception_high_surrogate":"Substituto alto n\xE3o seguido por um substituto baixo em fixedCharCodeAt()","exception_string_length":"Cadeia inv\xE1lida. O comprimento tem de ser um m\xFAltiplo de 4","exception_key_nonobject":"Object.keys chamou um n\xE3o-objeto","exception_null_or_undefined":" \xE9 nulo ou n\xE3o est\xE1 definido","exception_not_function":" n\xE3o \xE9 uma fun\xE7\xE3o","exception_invalid_date_format":"Formato de data inv\xE1lido: ","exception_casting":"N\xE3o \xE9 poss\xEDvel adicionar ","exception_casting_to":" at\xE9 "},"pt_br":{"latex":"LaTeX","cancel":"Cancelar","accept":"Inserir","manual":"Manual","insert_math":"Inserir f\xF3rmula matem\xE1tica - MathType","insert_chem":"Insira uma f\xF3rmula qu\xEDmica - ChemType","minimize":"Minimizar","maximize":"Maximizar","fullscreen":"Tela cheia","exit_fullscreen":"Sair de tela cheia","close":"Fechar","mathtype":"MathType","title_modalwindow":"Janela modal do MathType","close_modal_warning":"Tem certeza de que deseja sair? Todas as altera\xE7\xF5es ser\xE3o perdidas.","latex_name_label":"F\xF3rmula LaTeX","browser_no_compatible":"O navegador n\xE3o \xE9 compat\xEDvel com a tecnologia AJAX. Use a vers\xE3o mais recente do Mozilla Firefox.","error_convert_accessibility":"Erro ao converter de MathML para texto acess\xEDvel.","exception_cross_site":"O uso de scripts entre sites s\xF3 \xE9 permitido para HTTP.","exception_high_surrogate":"High surrogate n\xE3o seguido de low surrogate em fixedCharCodeAt()","exception_string_length":"String inv\xE1lida. O comprimento deve ser um m\xFAltiplo de 4","exception_key_nonobject":"Object.keys chamados em n\xE3o objeto","exception_null_or_undefined":" isto \xE9 nulo ou n\xE3o definido","exception_not_function":" n\xE3o \xE9 uma fun\xE7\xE3o","exception_invalid_date_format":"Formato de data inv\xE1lido: ","exception_casting":"N\xE3o \xE9 poss\xEDvel transmitir ","exception_casting_to":" para "},"ro":{"latex":"LaTeX","cancel":"Anulare","accept":"Insera\u021Bi","manual":"Ghid","insert_math":"Insera\u021Bi o formul\u0103 matematic\u0103 - MathType","insert_chem":"Insera\u021Bi o formul\u0103 chimic\u0103 - ChemType","minimize":"Minimiza\u021Bi","maximize":"Maximiza\u021Bi","fullscreen":"Afi\u0219a\u021Bi pe tot ecranul","exit_fullscreen":"Opri\u021Bi afi\u0219area pe tot ecranul","close":"\xCEnchide\u021Bi","mathtype":"MathType","title_modalwindow":"Fereastr\u0103 modal\u0103 MathType","close_modal_warning":"Sigur dori\u021Bi s\u0103 ie\u0219i\u021Bi? Modific\u0103rile realizate se vor pierde.","latex_name_label":"Formul\u0103 Latex","browser_no_compatible":"Browserul dvs. nu este compatibil cu tehnologia AJAX. Utiliza\u021Bi cea mai recent\u0103 versiune de Mozilla Firefox.","error_convert_accessibility":"Eroare la convertirea din MathML \xEEn text accesibil.","exception_cross_site":"Scriptarea \xEEntre site\u2011uri este permis\u0103 doar pentru HTTP.","exception_high_surrogate":"Surogatul superior nu este urmat de un surogat inferior \xEEn fixedCharCodeAt()","exception_string_length":"\u0218ir nevalid. Lungimea trebuie s\u0103 fie multiplu de 4","exception_key_nonobject":"Object.keys a apelat un non-obiect","exception_null_or_undefined":" este null sau nu este definit","exception_not_function":" nu este func\u021Bie","exception_invalid_date_format":"Format de dat\u0103 nevalid: ","exception_casting":"nu se poate difuza ","exception_casting_to":" c\u0103tre "},"ru":{"latex":"LaTeX","cancel":"\u043E\u0442\u043C\u0435\u043D\u0430","accept":"\u0412\u0441\u0442\u0430\u0432\u043A\u0430","manual":"\u0432\u0440\u0443\u0447\u043D\u0443\u044E","insert_math":"\u0412\u0441\u0442\u0430\u0432\u0438\u0442\u044C \u043C\u0430\u0442\u0435\u043C\u0430\u0442\u0438\u0447\u0435\u0441\u043A\u0443\u044E \u0444\u043E\u0440\u043C\u0443\u043B\u0443: WIRIS","insert_chem":"\u0412\u0441\u0442\u0430\u0432\u0438\u0442\u044C \u0445\u0438\u043C\u0438\u0447\u0435\u0441\u043A\u0443\u044E \u0444\u043E\u0440\u043C\u0443\u043B\u0443\xA0\u2014 ChemType","minimize":"\u0421\u0432\u0435\u0440\u043D\u0443\u0442\u044C","maximize":"\u0420\u0430\u0437\u0432\u0435\u0440\u043D\u0443\u0442\u044C","fullscreen":"\u041D\u0430 \u0432\u0435\u0441\u044C \u044D\u043A\u0440\u0430\u043D","exit_fullscreen":"\u0412\u044B\u0439\u0442\u0438 \u0438\u0437 \u043F\u043E\u043B\u043D\u043E\u044D\u043A\u0440\u0430\u043D\u043D\u043E\u0433\u043E \u0440\u0435\u0436\u0438\u043C\u0430","close":"\u0417\u0430\u043A\u0440\u044B\u0442\u044C","mathtype":"MathType","title_modalwindow":"\u0420\u0435\u0436\u0438\u043C\u043D\u043E\u0435 \u043E\u043A\u043D\u043E MathType","close_modal_warning":"\u0412\u044B \u0443\u0432\u0435\u0440\u0435\u043D\u044B, \u0447\u0442\u043E \u0445\u043E\u0442\u0438\u0442\u0435 \u0432\u044B\u0439\u0442\u0438? \u0412\u0441\u0435 \u0432\u043D\u0435\u0441\u0435\u043D\u043D\u044B\u0435 \u0438\u0437\u043C\u0435\u043D\u0435\u043D\u0438\u044F \u0431\u0443\u0434\u0443\u0442 \u0443\u0442\u0440\u0430\u0447\u0435\u043D\u044B.","latex_name_label":"\u0424\u043E\u0440\u043C\u0443\u043B\u0430 Latex","browser_no_compatible":"\u0412\u0430\u0448 \u0431\u0440\u0430\u0443\u0437\u0435\u0440 \u043D\u0435\u0441\u043E\u0432\u043C\u0435\u0441\u0442\u0438\u043C \u0441 \u0442\u0435\u0445\u043D\u043E\u043B\u043E\u0433\u0438\u0435\u0439 AJAX. \u0418\u0441\u043F\u043E\u043B\u044C\u0437\u0443\u0439\u0442\u0435 \u043F\u043E\u0441\u043B\u0435\u0434\u043D\u044E\u044E \u0432\u0435\u0440\u0441\u0438\u044E Mozilla\xA0Firefox.","error_convert_accessibility":"\u041F\u0440\u0438 \u043F\u0440\u0435\u043E\u0431\u0440\u0430\u0437\u043E\u0432\u0430\u043D\u0438\u0438 \u0444\u043E\u0440\u043C\u0443\u043B\u044B \u0432 \u0442\u0435\u043A\u0441\u0442 \u0434\u043E\u043F\u0443\u0441\u0442\u0438\u043C\u043E\u0433\u043E \u0444\u043E\u0440\u043C\u0430\u0442\u0430 \u043F\u0440\u043E\u0438\u0437\u043E\u0448\u043B\u0430 \u043E\u0448\u0438\u0431\u043A\u0430.","exception_cross_site":"\u041C\u0435\u0436\u0441\u0430\u0439\u0442\u043E\u0432\u044B\u0435 \u0441\u0446\u0435\u043D\u0430\u0440\u0438\u0438 \u0434\u043E\u0441\u0442\u0443\u043F\u043D\u044B \u0442\u043E\u043B\u044C\u043A\u043E \u0434\u043B\u044F HTTP.","exception_high_surrogate":"\u041C\u043B\u0430\u0434\u0448\u0438\u0439 \u0441\u0438\u043C\u0432\u043E\u043B-\u0437\u0430\u043C\u0435\u0441\u0442\u0438\u0442\u0435\u043B\u044C \u043D\u0435 \u0441\u043E\u043F\u0440\u043E\u0432\u043E\u0436\u0434\u0430\u0435\u0442 \u0441\u0442\u0430\u0440\u0448\u0438\u0439 \u0441\u0438\u043C\u0432\u043E\u043B-\u0437\u0430\u043C\u0435\u0441\u0442\u0438\u0442\u0435\u043B\u044C \u0432 \u0438\u0441\u043F\u0440\u0430\u0432\u043B\u0435\u043D\u043D\u043E\u043C \u043C\u0435\u0442\u043E\u0434\u0435 CharCodeAt()","exception_string_length":"\u041D\u0435\u0434\u043E\u043F\u0443\u0441\u0442\u0438\u043C\u0430\u044F \u0441\u0442\u0440\u043E\u043A\u0430. \u0414\u043B\u0438\u043D\u043D\u0430 \u0434\u043E\u043B\u0436\u043D\u0430 \u0431\u044B\u0442\u044C \u043A\u0440\u0430\u0442\u043D\u043E\u0439 4.","exception_key_nonobject":"\u041C\u0435\u0442\u043E\u0434 Object.keys \u0432\u044B\u0437\u0432\u0430\u043D \u043D\u0435 \u0434\u043B\u044F \u043E\u0431\u044A\u0435\u043A\u0442\u0430","exception_null_or_undefined":" \u0437\u043D\u0430\u0447\u0435\u043D\u0438\u0435 \u043F\u0443\u0441\u0442\u043E\u0435 \u0438\u043B\u0438 \u043D\u0435 \u043E\u043F\u0440\u0435\u0434\u0435\u043B\u0435\u043D\u043E","exception_not_function":" \u043D\u0435 \u0444\u0443\u043D\u043A\u0446\u0438\u044F","exception_invalid_date_format":"\u041D\u0435\u0434\u043E\u043F\u0443\u0441\u0442\u0438\u043C\u044B\u0439 \u0444\u043E\u0440\u043C\u0430\u0442 \u0434\u0430\u0442\u044B: ","exception_casting":"\u041D\u0435 \u0443\u0434\u0430\u0435\u0442\u0441\u044F \u043F\u0440\u0438\u0432\u0435\u0441\u0442\u0438 ","exception_casting_to":" \u043A "},"sv":{"latex":"LaTeX","cancel":"Avbryt","accept":"Infoga","manual":"Bruksanvisning","insert_math":"Infoga matematisk formel - MathType","insert_chem":"Infoga en kemiformel \u2013 ChemType","minimize":"Minimera","maximize":"Maximera","fullscreen":"Helsk\xE4rm","exit_fullscreen":"St\xE4ng helsk\xE4rm","close":"St\xE4ng","mathtype":"MathType","title_modalwindow":"MathType modulf\xF6nster","close_modal_warning":"Vill du avsluta? Inga \xE4ndringar kommer att sparas.","latex_name_label":"Latex-formel","browser_no_compatible":"Din webbl\xE4sare \xE4r inte kompatibel med AJAX-teknik. Anv\xE4nd den senaste versionen av Mozilla Firefox.","error_convert_accessibility":"Det uppstod ett fel vid konvertering fr\xE5n MathML till \xE5tkomlig text.","exception_cross_site":"Skriptk\xF6rning \xF6ver flera sajter \xE4r endast till\xE5tet f\xF6r HTTP.","exception_high_surrogate":"H\xF6g surrogat f\xF6ljs inte av l\xE5g surrogat i fixedCharCodeAt()","exception_string_length":"Ogiltig str\xE4ng. L\xE4ngden m\xE5ste vara en multipel av 4","exception_key_nonobject":"Object.keys anropade icke-objekt","exception_null_or_undefined":" det \xE4r null eller inte definierat","exception_not_function":" \xE4r inte en funktion","exception_invalid_date_format":"Ogiltigt datumformat: ","exception_casting":"G\xE5r inte att konvertera ","exception_casting_to":" till "},"tr":{"latex":"LaTeX","cancel":"Vazge\xE7","accept":"Ekle","manual":"K\u0131lavuz","insert_math":"Matematik form\xFCl\xFC ekle - MathType","insert_chem":"Kimya form\xFCl\xFC ekleyin - ChemType","minimize":"Simge Durumuna K\xFC\xE7\xFClt","maximize":"Ekran\u0131 Kapla","fullscreen":"Tam Ekran","exit_fullscreen":"Tam Ekrandan \xC7\u0131k","close":"Kapat","mathtype":"MathType","title_modalwindow":"MathType kal\u0131c\u0131 penceresi","close_modal_warning":"\xC7\u0131kmak istedi\u011Finizden emin misiniz? Yapt\u0131\u011F\u0131n\u0131z de\u011Fi\u015Fiklikler kaybolacak.","latex_name_label":"Latex Form\xFCl\xFC","browser_no_compatible":"Taray\u0131c\u0131n\u0131z AJAX teknolojisiyle uyumlu de\u011Fil. L\xFCtfen en g\xFCncel Mozilla Firefox s\xFCr\xFCm\xFCn\xFC kullan\u0131n.","error_convert_accessibility":"MathML bi\xE7iminden eri\u015Filebilir metne d\xF6n\xFC\u015Ft\xFCrme hatas\u0131.","exception_cross_site":"Siteler aras\u0131 komut dosyas\u0131 yazma i\u015Flemine yaln\u0131zca HTTP i\xE7in izin verilir.","exception_high_surrogate":"fixedCharCodeAt() fonksiyonunda \xFCst vekilin ard\u0131ndan alt vekil gelmiyor","exception_string_length":"Ge\xE7ersiz dizgi. Uzunluk, 4\'\xFCn katlar\u0131ndan biri olmal\u0131d\u0131r","exception_key_nonobject":"Nesne olmayan \xF6\u011Fe \xFCzerinde Object.keys \xE7a\u011Fr\u0131ld\u0131","exception_null_or_undefined":" bu de\u011Fer bo\u015F veya tan\u0131mlanmam\u0131\u015F","exception_not_function":" bir fonksiyon de\u011Fil","exception_invalid_date_format":"Ge\xE7ersiz tarih bi\xE7imi: ","exception_casting":"T\xFCr d\xF6n\xFC\u015Ft\xFCr\xFClemiyor ","exception_casting_to":" hedef: "},"zh":{"latex":"LaTeX","cancel":"\u53D6\u6D88","accept":"\u63D2\u5165","manual":"\u624B\u518C","insert_math":"\u63D2\u5165\u6570\u5B66\u516C\u5F0F - MathType","insert_chem":"\u63D2\u5165\u5316\u5B66\u5206\u5B50\u5F0F - ChemType","minimize":"\u6700\u5C0F\u5316","maximize":"\u6700\u5927\u5316","fullscreen":"\u5168\u5C4F\u5E55","exit_fullscreen":"\u9000\u51FA\u5168\u5C4F\u5E55","close":"\u5173\u95ED","mathtype":"MathType","title_modalwindow":"MathType \u6A21\u5F0F\u7A97\u53E3","close_modal_warning":"\u60A8\u786E\u5B9A\u8981\u79BB\u5F00\u5417\uFF1F\u60A8\u6240\u505A\u7684\u4FEE\u6539\u5C06\u4E22\u5931\u3002","latex_name_label":"Latex \u5206\u5B50\u5F0F","browser_no_compatible":"\u60A8\u7684\u6D4F\u89C8\u5668\u4E0D\u517C\u5BB9 AJAX \u6280\u672F\u3002\u8BF7\u4F7F\u7528\u6700\u65B0\u7248 Mozilla Firefox\u3002","error_convert_accessibility":"\u5C06 MathML \u8F6C\u6362\u4E3A\u53EF\u8BBF\u95EE\u6587\u672C\u65F6\u51FA\u9519\u3002","exception_cross_site":"\u4EC5 HTTP \u5141\u8BB8\u8DE8\u7AD9\u811A\u672C\u3002","exception_high_surrogate":"fixedCharCodeAt() \u4E2D\u7684\u9AD8\u4F4D\u4EE3\u7406\u4E4B\u540E\u672A\u8DDF\u968F\u4F4E\u4F4D\u4EE3\u7406","exception_string_length":"\u65E0\u6548\u5B57\u7B26\u4E32\u3002\u957F\u5EA6\u5FC5\u987B\u662F 4 \u7684\u500D\u6570","exception_key_nonobject":"\u975E\u5BF9\u8C61\u8C03\u7528\u4E86 Object.keys","exception_null_or_undefined":" \u8BE5\u503C\u4E3A\u7A7A\u6216\u672A\u5B9A\u4E49","exception_not_function":" \u4E0D\u662F\u4E00\u4E2A\u51FD\u6570","exception_invalid_date_format":"\u65E0\u6548\u65E5\u671F\u683C\u5F0F\uFF1A ","exception_casting":"\u65E0\u6CD5\u8F6C\u6362 ","exception_casting_to":" \u4E3A "},"":{}}'
      );
    },
    function(e) {
      e.exports = JSON.parse('{"a":"7.26.0"}');
    },
    function(module, __webpack_exports__, __webpack_require__) {
      'use strict';
      function _typeof(e) {
        return (_typeof =
          typeof Symbol == 'function' && typeof Symbol.iterator == 'symbol'
            ? function(e) {
                return typeof e;
              }
            : function(e) {
                if (
                  e &&
                  typeof Symbol == 'function' &&
                  e.constructor === Symbol &&
                  e !== Symbol.prototype
                ) {
                  return 'symbol';
                } else {
                  return typeof e;
                }
              })(e);
      }
      var md5;
      var _unused_webpack_default_export = md5;
      (function() {
        function $bind(e, t) {
          var n = function e() {
            return e.method.apply(e.scope, arguments);
          };
          n.scope = e;
          n.method = t;
          return n;
        }
        var HxOverrides = function() {};
        HxOverrides.__name__ = true;
        HxOverrides.dateStr = function(e) {
          var t = e.getMonth() + 1;
          var n = e.getDate();
          var i = e.getHours();
          var r = e.getMinutes();
          var a = e.getSeconds();
          return (
            e.getFullYear() +
            '-' +
            (t < 10 ? '0' + t : '' + t) +
            '-' +
            (n < 10 ? '0' + n : '' + n) +
            ' ' +
            (i < 10 ? '0' + i : '' + i) +
            ':' +
            (r < 10 ? '0' + r : '' + r) +
            ':' +
            (a < 10 ? '0' + a : '' + a)
          );
        };
        HxOverrides.strDate = function(e) {
          switch (e.length) {
            case 8:
              var t = e.split(':');
              var n = new Date();
              n.setTime(0);
              n.setUTCHours(t[0]);
              n.setUTCMinutes(t[1]);
              n.setUTCSeconds(t[2]);
              return n;
            case 10:
              t = e.split('-');
              return new Date(t[0], t[1] - 1, t[2], 0, 0, 0);
            case 19:
              var i = (t = e.split(' '))[0].split('-');
              var r = t[1].split(':');
              return new Date(i[0], i[1] - 1, i[2], r[0], r[1], r[2]);
            default:
              throw 'Invalid date format : ' + e;
          }
        };
        HxOverrides.cca = function(e, t) {
          var n = e.charCodeAt(t);
          if (n == n) {
            return n;
          }
        };
        HxOverrides.substr = function(e, t, n) {
          if (t != null && t != 0 && n != null && n < 0) {
            return '';
          } else {
            if (n == null) {
              n = e.length;
            }
            if (t < 0) {
              if ((t = e.length + t) < 0) {
                t = 0;
              }
            } else if (n < 0) {
              n = e.length + n - t;
            }
            return e.substr(t, n);
          }
        };
        HxOverrides.remove = function(e, t) {
          var n = 0;
          for (var i = e.length; n < i; ) {
            if (e[n] == t) {
              e.splice(n, 1);
              return true;
            }
            n++;
          }
          return false;
        };
        HxOverrides.iter = function(e) {
          return {
            cur: 0,
            arr: e,
            hasNext: function() {
              return this.cur < this.arr.length;
            },
            next: function() {
              return this.arr[this.cur++];
            },
          };
        };
        var IntIter = function(e, t) {
          this.min = e;
          this.max = t;
        };
        IntIter.__name__ = true;
        IntIter.prototype = {
          next: function() {
            return this.min++;
          },
          hasNext: function() {
            return this.min < this.max;
          },
          __class__: IntIter,
        };
        var Std = function() {};
        Std.__name__ = true;
        Std.is = function(e, t) {
          return js.Boot.__instanceof(e, t);
        };
        Std.string = function(e) {
          return js.Boot.__string_rec(e, '');
        };
        Std.int = function(e) {
          return 0 | e;
        };
        Std.parseInt = function(e) {
          var t = parseInt(e, 10);
          if (
            t == 0 &&
            (HxOverrides.cca(e, 1) == 120 || HxOverrides.cca(e, 1) == 88)
          ) {
            t = parseInt(e);
          }
          if (isNaN(t)) {
            return null;
          } else {
            return t;
          }
        };
        Std.parseFloat = function(e) {
          return parseFloat(e);
        };
        Std.random = function(e) {
          return Math.floor(Math.random() * e);
        };
        var com = com || {};
        if (!com.wiris) {
          com.wiris = {};
        }
        if (!com.wiris.js) {
          com.wiris.js = {};
        }
        com.wiris.js.JsPluginTools = function() {
          this.tryReady();
        };
        com.wiris.js.JsPluginTools.__name__ = true;
        com.wiris.js.JsPluginTools.main = function() {
          var e = com.wiris.js.JsPluginTools.getInstance();
          haxe.Timer.delay($bind(e, e.tryReady), 100);
        };
        com.wiris.js.JsPluginTools.getInstance = function() {
          if (com.wiris.js.JsPluginTools.instance == null) {
            com.wiris.js.JsPluginTools.instance = new com.wiris.js.JsPluginTools();
          }
          return com.wiris.js.JsPluginTools.instance;
        };
        com.wiris.js.JsPluginTools.bypassEncapsulation = function() {
          if (window.com == null) {
            window.com = {};
          }
          if (window.com.wiris == null) {
            window.com.wiris = {};
          }
          if (window.com.wiris.js == null) {
            window.com.wiris.js = {};
          }
          if (window.com.wiris.js.JsPluginTools == null) {
            window.com.wiris.js.JsPluginTools = com.wiris.js.JsPluginTools.getInstance();
          }
        };
        com.wiris.js.JsPluginTools.prototype = {
          md5encode: function(e) {
            return haxe.Md5.encode(e);
          },
          doLoad: function() {
            this.ready = true;
            com.wiris.js.JsPluginTools.instance = this;
            com.wiris.js.JsPluginTools.bypassEncapsulation();
          },
          tryReady: function() {
            this.ready = false;
            if (js.Lib.document.readyState) {
              this.doLoad();
              this.ready = true;
            }
            if (!this.ready) {
              haxe.Timer.delay($bind(this, this.tryReady), 100);
            }
          },
          __class__: com.wiris.js.JsPluginTools,
        };
        var haxe = haxe || {};
        haxe.Log = function() {};
        haxe.Log.__name__ = true;
        haxe.Log.trace = function(e, t) {
          js.Boot.__trace(e, t);
        };
        haxe.Log.clear = function() {
          js.Boot.__clear_trace();
        };
        haxe.Md5 = function() {};
        haxe.Md5.__name__ = true;
        haxe.Md5.encode = function(e) {
          return new haxe.Md5().doEncode(e);
        };
        haxe.Md5.prototype = {
          doEncode: function(e) {
            var t = this.str2blks(e);
            var n = 1732584193;
            var i = -271733879;
            var r = -1732584194;
            var a = 271733878;
            for (var o = 0; o < t.length; ) {
              var s = n;
              var l = i;
              var c = r;
              var u = a;
              n = this.ff(n, i, r, a, t[o], 7, -680876936);
              a = this.ff(a, n, i, r, t[o + 1], 12, -389564586);
              r = this.ff(r, a, n, i, t[o + 2], 17, 606105819);
              i = this.ff(i, r, a, n, t[o + 3], 22, -1044525330);
              n = this.ff(n, i, r, a, t[o + 4], 7, -176418897);
              a = this.ff(a, n, i, r, t[o + 5], 12, 1200080426);
              r = this.ff(r, a, n, i, t[o + 6], 17, -1473231341);
              i = this.ff(i, r, a, n, t[o + 7], 22, -45705983);
              n = this.ff(n, i, r, a, t[o + 8], 7, 1770035416);
              a = this.ff(a, n, i, r, t[o + 9], 12, -1958414417);
              r = this.ff(r, a, n, i, t[o + 10], 17, -42063);
              i = this.ff(i, r, a, n, t[o + 11], 22, -1990404162);
              n = this.ff(n, i, r, a, t[o + 12], 7, 1804603682);
              a = this.ff(a, n, i, r, t[o + 13], 12, -40341101);
              r = this.ff(r, a, n, i, t[o + 14], 17, -1502002290);
              i = this.ff(i, r, a, n, t[o + 15], 22, 1236535329);
              n = this.gg(n, i, r, a, t[o + 1], 5, -165796510);
              a = this.gg(a, n, i, r, t[o + 6], 9, -1069501632);
              r = this.gg(r, a, n, i, t[o + 11], 14, 643717713);
              i = this.gg(i, r, a, n, t[o], 20, -373897302);
              n = this.gg(n, i, r, a, t[o + 5], 5, -701558691);
              a = this.gg(a, n, i, r, t[o + 10], 9, 38016083);
              r = this.gg(r, a, n, i, t[o + 15], 14, -660478335);
              i = this.gg(i, r, a, n, t[o + 4], 20, -405537848);
              n = this.gg(n, i, r, a, t[o + 9], 5, 568446438);
              a = this.gg(a, n, i, r, t[o + 14], 9, -1019803690);
              r = this.gg(r, a, n, i, t[o + 3], 14, -187363961);
              i = this.gg(i, r, a, n, t[o + 8], 20, 1163531501);
              n = this.gg(n, i, r, a, t[o + 13], 5, -1444681467);
              a = this.gg(a, n, i, r, t[o + 2], 9, -51403784);
              r = this.gg(r, a, n, i, t[o + 7], 14, 1735328473);
              i = this.gg(i, r, a, n, t[o + 12], 20, -1926607734);
              n = this.hh(n, i, r, a, t[o + 5], 4, -378558);
              a = this.hh(a, n, i, r, t[o + 8], 11, -2022574463);
              r = this.hh(r, a, n, i, t[o + 11], 16, 1839030562);
              i = this.hh(i, r, a, n, t[o + 14], 23, -35309556);
              n = this.hh(n, i, r, a, t[o + 1], 4, -1530992060);
              a = this.hh(a, n, i, r, t[o + 4], 11, 1272893353);
              r = this.hh(r, a, n, i, t[o + 7], 16, -155497632);
              i = this.hh(i, r, a, n, t[o + 10], 23, -1094730640);
              n = this.hh(n, i, r, a, t[o + 13], 4, 681279174);
              a = this.hh(a, n, i, r, t[o], 11, -358537222);
              r = this.hh(r, a, n, i, t[o + 3], 16, -722521979);
              i = this.hh(i, r, a, n, t[o + 6], 23, 76029189);
              n = this.hh(n, i, r, a, t[o + 9], 4, -640364487);
              a = this.hh(a, n, i, r, t[o + 12], 11, -421815835);
              r = this.hh(r, a, n, i, t[o + 15], 16, 530742520);
              i = this.hh(i, r, a, n, t[o + 2], 23, -995338651);
              n = this.ii(n, i, r, a, t[o], 6, -198630844);
              a = this.ii(a, n, i, r, t[o + 7], 10, 1126891415);
              r = this.ii(r, a, n, i, t[o + 14], 15, -1416354905);
              i = this.ii(i, r, a, n, t[o + 5], 21, -57434055);
              n = this.ii(n, i, r, a, t[o + 12], 6, 1700485571);
              a = this.ii(a, n, i, r, t[o + 3], 10, -1894986606);
              r = this.ii(r, a, n, i, t[o + 10], 15, -1051523);
              i = this.ii(i, r, a, n, t[o + 1], 21, -2054922799);
              n = this.ii(n, i, r, a, t[o + 8], 6, 1873313359);
              a = this.ii(a, n, i, r, t[o + 15], 10, -30611744);
              r = this.ii(r, a, n, i, t[o + 6], 15, -1560198380);
              i = this.ii(i, r, a, n, t[o + 13], 21, 1309151649);
              n = this.ii(n, i, r, a, t[o + 4], 6, -145523070);
              a = this.ii(a, n, i, r, t[o + 11], 10, -1120210379);
              r = this.ii(r, a, n, i, t[o + 2], 15, 718787259);
              i = this.ii(i, r, a, n, t[o + 9], 21, -343485551);
              n = this.addme(n, s);
              i = this.addme(i, l);
              r = this.addme(r, c);
              a = this.addme(a, u);
              o += 16;
            }
            return this.rhex(n) + this.rhex(i) + this.rhex(r) + this.rhex(a);
          },
          ii: function(e, t, n, i, r, a, o) {
            return this.cmn(this.bitXOR(n, this.bitOR(t, ~i)), e, t, r, a, o);
          },
          hh: function(e, t, n, i, r, a, o) {
            return this.cmn(this.bitXOR(this.bitXOR(t, n), i), e, t, r, a, o);
          },
          gg: function(e, t, n, i, r, a, o) {
            return this.cmn(
              this.bitOR(this.bitAND(t, i), this.bitAND(n, ~i)),
              e,
              t,
              r,
              a,
              o
            );
          },
          ff: function(e, t, n, i, r, a, o) {
            return this.cmn(
              this.bitOR(this.bitAND(t, n), this.bitAND(~t, i)),
              e,
              t,
              r,
              a,
              o
            );
          },
          cmn: function(e, t, n, i, r, a) {
            return this.addme(
              this.rol(this.addme(this.addme(t, e), this.addme(i, a)), r),
              n
            );
          },
          rol: function(e, t) {
            return (e << t) | (e >>> (32 - t));
          },
          str2blks: function(e) {
            var t = 1 + ((e.length + 8) >> 6);
            var n = new Array();
            var i = 0;
            for (var r = 16 * t; i < r; ) {
              n[(a = i++)] = 0;
            }
            for (var a = 0; a < e.length; ) {
              n[a >> 2] |=
                HxOverrides.cca(e, a) << (((8 * e.length + a) % 4) * 8);
              a++;
            }
            n[a >> 2] |= 128 << (((8 * e.length + a) % 4) * 8);
            var o = 8 * e.length;
            var s = 16 * t - 2;
            n[s] = 255 & o;
            n[s] |= ((o >>> 8) & 255) << 8;
            n[s] |= ((o >>> 16) & 255) << 16;
            n[s] |= ((o >>> 24) & 255) << 24;
            return n;
          },
          rhex: function(e) {
            var t = '';
            for (var n = 0; n < 4; ) {
              var i = n++;
              t +=
                '0123456789abcdef'.charAt((e >> (8 * i + 4)) & 15) +
                '0123456789abcdef'.charAt((e >> (8 * i)) & 15);
            }
            return t;
          },
          addme: function(e, t) {
            var n = (65535 & e) + (65535 & t);
            return (((e >> 16) + (t >> 16) + (n >> 16)) << 16) | (65535 & n);
          },
          bitAND: function(e, t) {
            return (((e >>> 1) & (t >>> 1)) << 1) | (1 & e & t);
          },
          bitXOR: function(e, t) {
            return (((e >>> 1) ^ (t >>> 1)) << 1) | ((1 & e) ^ (1 & t));
          },
          bitOR: function(e, t) {
            return (((e >>> 1) | (t >>> 1)) << 1) | ((1 & e) | (1 & t));
          },
          __class__: haxe.Md5,
        };
        haxe.Timer = function(e) {
          var t = this;
          this.id = window.setInterval(function() {
            t.run();
          }, e);
        };
        haxe.Timer.__name__ = true;
        haxe.Timer.delay = function(e, t) {
          var n = new haxe.Timer(t);
          n.run = function() {
            n.stop();
            e();
          };
          return n;
        };
        haxe.Timer.measure = function(e, t) {
          var n = haxe.Timer.stamp();
          var i = e();
          haxe.Log.trace(haxe.Timer.stamp() - n + 's', t);
          return i;
        };
        haxe.Timer.stamp = function() {
          return new Date().getTime() / 1e3;
        };
        haxe.Timer.prototype = {
          run: function() {},
          stop: function() {
            if (this.id != null) {
              window.clearInterval(this.id);
              this.id = null;
            }
          },
          __class__: haxe.Timer,
        };
        var js = js || {};
        var $_;
        js.Boot = function() {};
        js.Boot.__name__ = true;
        js.Boot.__unhtml = function(e) {
          return e
            .split('&')
            .join('&amp;')
            .split('<')
            .join('&lt;')
            .split('>')
            .join('&gt;');
        };
        js.Boot.__trace = function(e, t) {
          var n;
          var i = t != null ? t.fileName + ':' + t.lineNumber + ': ' : '';
          i += js.Boot.__string_rec(e, '');
          if (
            typeof document != 'undefined' &&
            (n = document.getElementById('haxe:trace')) != null
          ) {
            n.innerHTML += js.Boot.__unhtml(i) + '<br/>';
          } else if (typeof console != 'undefined' && console.log != null) {
            console.log(i);
          }
        };
        js.Boot.__clear_trace = function() {
          var e = document.getElementById('haxe:trace');
          if (e != null) {
            e.innerHTML = '';
          }
        };
        js.Boot.isClass = function(e) {
          return e.__name__;
        };
        js.Boot.isEnum = function(e) {
          return e.__ename__;
        };
        js.Boot.getClass = function(e) {
          return e.__class__;
        };
        js.Boot.__string_rec = function(e, t) {
          if (e == null) {
            return 'null';
          }
          if (t.length >= 5) {
            return '<...>';
          }
          var n = _typeof(e);
          switch ((n == 'function' &&
            (e.__name__ || e.__ename__) &&
            (n = 'object'),
          n)) {
            case 'object':
              if (e instanceof Array) {
                if (e.__enum__) {
                  if (e.length == 2) {
                    return e[0];
                  }
                  var i = e[0] + '(';
                  t += '\x09';
                  var r = 2;
                  for (var a = e.length; r < a; ) {
                    i +=
                      (o = r++) != 2
                        ? ',' + js.Boot.__string_rec(e[o], t)
                        : js.Boot.__string_rec(e[o], t);
                  }
                  return i + ')';
                }
                var o;
                var s = e.length;
                i = '[';
                t += '\x09';
                for (a = 0; a < s; ) {
                  var l = a++;
                  i += (l > 0 ? ',' : '') + js.Boot.__string_rec(e[l], t);
                }
                return (i += ']');
              }
              var c;
              try {
                c = e.toString;
              } catch (e) {
                return '???';
              }
              if (c != null && c != Object.toString) {
                var u = e.toString();
                if (u != '[object Object]') {
                  return u;
                }
              }
              var d = null;
              i = '{\n';
              t += '\x09';
              var m = e.hasOwnProperty != null;
              for (var d in e) {
                if (!m || !!e.hasOwnProperty(d)) {
                  if (
                    d != 'prototype' &&
                    d != '__class__' &&
                    d != '__super__' &&
                    d != '__interfaces__' &&
                    d != '__properties__'
                  ) {
                    if (i.length != 2) {
                      i += ', \n';
                    }
                    i += t + d + ' : ' + js.Boot.__string_rec(e[d], t);
                  }
                }
              }
              return (i += '\n' + (t = t.substring(1)) + '}');
            case 'function':
              return '<function>';
            case 'string':
              return e;
            default:
              return String(e);
          }
        };
        js.Boot.__interfLoop = function(e, t) {
          if (e == null) {
            return false;
          }
          if (e == t) {
            return true;
          }
          var n = e.__interfaces__;
          if (n != null) {
            var i = 0;
            for (var r = n.length; i < r; ) {
              var a = n[i++];
              if (a == t || js.Boot.__interfLoop(a, t)) {
                return true;
              }
            }
          }
          return js.Boot.__interfLoop(e.__super__, t);
        };
        js.Boot.__instanceof = function(e, t) {
          try {
            if (e instanceof t) {
              return t != Array || e.__enum__ == null;
            }
            if (js.Boot.__interfLoop(e.__class__, t)) {
              return true;
            }
          } catch (e) {
            if (t == null) {
              return false;
            }
          }
          switch (t) {
            case Int:
              return Math.ceil(e % 2147483648) === e;
            case Float:
              return typeof e == 'number';
            case Bool:
              return e === true || e === false;
            case String:
              return typeof e == 'string';
            case Dynamic:
              return true;
            default:
              return (
                e != null &&
                ((t == Class && e.__name__ != null) ||
                  ((t == Enum && e.__ename__ != null) || e.__enum__ == t))
              );
          }
        };
        js.Boot.__cast = function(e, t) {
          if (js.Boot.__instanceof(e, t)) {
            return e;
          }
          throw 'Cannot cast ' + Std.string(e) + ' to ' + Std.string(t);
        };
        js.Lib = function() {};
        js.Lib.__name__ = true;
        js.Lib.debug = function() {};
        js.Lib.alert = function(e) {
          alert(js.Boot.__string_rec(e, ''));
        };
        js.Lib.eval = function(code) {
          return eval(code);
        };
        js.Lib.setErrorHandler = function(e) {
          js.Lib.onerror = e;
        };
        if (Array.prototype.indexOf) {
          HxOverrides.remove = function(e, t) {
            var n = e.indexOf(t);
            return n != -1 && (e.splice(n, 1), true);
          };
        }
        Math.__name__ = ['Math'];
        Math.NaN = Number.NaN;
        Math.NEGATIVE_INFINITY = Number.NEGATIVE_INFINITY;
        Math.POSITIVE_INFINITY = Number.POSITIVE_INFINITY;
        Math.isFinite = function(e) {
          return isFinite(e);
        };
        Math.isNaN = function(e) {
          return isNaN(e);
        };
        String.prototype.__class__ = String;
        String.__name__ = true;
        Array.prototype.__class__ = Array;
        Array.__name__ = true;
        Date.prototype.__class__ = Date;
        Date.__name__ = ['Date'];
        var Int = { __name__: ['Int'] };
        var Dynamic = { __name__: ['Dynamic'] };
        var Float = Number;
        Float.__name__ = ['Float'];
        var Bool = Boolean;
        Bool.__ename__ = ['Bool'];
        var Class = { __name__: ['Class'] };
        var Enum = {};
        var Void = { __ename__: ['Void'] };
        if (typeof document != 'undefined') {
          js.Lib.document = document;
        }
        if (typeof window != 'undefined') {
          js.Lib.window = window;
          js.Lib.window.onerror = function(e, t, n) {
            var i = js.Lib.onerror;
            return i != null && i(e, [t + ':' + n]);
          };
        }
        com.wiris.js.JsPluginTools.main();
        delete Array.prototype.__class__;
      })();
      (function() {
        function $bind(e, t) {
          var n = function e() {
            return e.method.apply(e.scope, arguments);
          };
          n.scope = e;
          n.method = t;
          return n;
        }
        var HxOverrides = function() {};
        HxOverrides.__name__ = true;
        HxOverrides.dateStr = function(e) {
          var t = e.getMonth() + 1;
          var n = e.getDate();
          var i = e.getHours();
          var r = e.getMinutes();
          var a = e.getSeconds();
          return (
            e.getFullYear() +
            '-' +
            (t < 10 ? '0' + t : '' + t) +
            '-' +
            (n < 10 ? '0' + n : '' + n) +
            ' ' +
            (i < 10 ? '0' + i : '' + i) +
            ':' +
            (r < 10 ? '0' + r : '' + r) +
            ':' +
            (a < 10 ? '0' + a : '' + a)
          );
        };
        HxOverrides.strDate = function(e) {
          switch (e.length) {
            case 8:
              var t = e.split(':');
              var n = new Date();
              n.setTime(0);
              n.setUTCHours(t[0]);
              n.setUTCMinutes(t[1]);
              n.setUTCSeconds(t[2]);
              return n;
            case 10:
              t = e.split('-');
              return new Date(t[0], t[1] - 1, t[2], 0, 0, 0);
            case 19:
              var i = (t = e.split(' '))[0].split('-');
              var r = t[1].split(':');
              return new Date(i[0], i[1] - 1, i[2], r[0], r[1], r[2]);
            default:
              throw 'Invalid date format : ' + e;
          }
        };
        HxOverrides.cca = function(e, t) {
          var n = e.charCodeAt(t);
          if (n == n) {
            return n;
          }
        };
        HxOverrides.substr = function(e, t, n) {
          if (t != null && t != 0 && n != null && n < 0) {
            return '';
          } else {
            if (n == null) {
              n = e.length;
            }
            if (t < 0) {
              if ((t = e.length + t) < 0) {
                t = 0;
              }
            } else if (n < 0) {
              n = e.length + n - t;
            }
            return e.substr(t, n);
          }
        };
        HxOverrides.remove = function(e, t) {
          var n = 0;
          for (var i = e.length; n < i; ) {
            if (e[n] == t) {
              e.splice(n, 1);
              return true;
            }
            n++;
          }
          return false;
        };
        HxOverrides.iter = function(e) {
          return {
            cur: 0,
            arr: e,
            hasNext: function() {
              return this.cur < this.arr.length;
            },
            next: function() {
              return this.arr[this.cur++];
            },
          };
        };
        var IntIter = function(e, t) {
          this.min = e;
          this.max = t;
        };
        IntIter.__name__ = true;
        IntIter.prototype = {
          next: function() {
            return this.min++;
          },
          hasNext: function() {
            return this.min < this.max;
          },
          __class__: IntIter,
        };
        var Std = function() {};
        Std.__name__ = true;
        Std.is = function(e, t) {
          return js.Boot.__instanceof(e, t);
        };
        Std.string = function(e) {
          return js.Boot.__string_rec(e, '');
        };
        Std.int = function(e) {
          return 0 | e;
        };
        Std.parseInt = function(e) {
          var t = parseInt(e, 10);
          if (
            t == 0 &&
            (HxOverrides.cca(e, 1) == 120 || HxOverrides.cca(e, 1) == 88)
          ) {
            t = parseInt(e);
          }
          if (isNaN(t)) {
            return null;
          } else {
            return t;
          }
        };
        Std.parseFloat = function(e) {
          return parseFloat(e);
        };
        Std.random = function(e) {
          return Math.floor(Math.random() * e);
        };
        var com = com || {};
        if (!com.wiris) {
          com.wiris = {};
        }
        if (!com.wiris.js) {
          com.wiris.js = {};
        }
        com.wiris.js.JsPluginTools = function() {
          this.tryReady();
        };
        com.wiris.js.JsPluginTools.__name__ = true;
        com.wiris.js.JsPluginTools.main = function() {
          var e = com.wiris.js.JsPluginTools.getInstance();
          haxe.Timer.delay($bind(e, e.tryReady), 100);
        };
        com.wiris.js.JsPluginTools.getInstance = function() {
          if (com.wiris.js.JsPluginTools.instance == null) {
            com.wiris.js.JsPluginTools.instance = new com.wiris.js.JsPluginTools();
          }
          return com.wiris.js.JsPluginTools.instance;
        };
        com.wiris.js.JsPluginTools.bypassEncapsulation = function() {
          if (window.com == null) {
            window.com = {};
          }
          if (window.com.wiris == null) {
            window.com.wiris = {};
          }
          if (window.com.wiris.js == null) {
            window.com.wiris.js = {};
          }
          if (window.com.wiris.js.JsPluginTools == null) {
            window.com.wiris.js.JsPluginTools = com.wiris.js.JsPluginTools.getInstance();
          }
        };
        com.wiris.js.JsPluginTools.prototype = {
          md5encode: function(e) {
            return haxe.Md5.encode(e);
          },
          doLoad: function() {
            this.ready = true;
            com.wiris.js.JsPluginTools.instance = this;
            com.wiris.js.JsPluginTools.bypassEncapsulation();
          },
          tryReady: function() {
            this.ready = false;
            if (js.Lib.document.readyState) {
              this.doLoad();
              this.ready = true;
            }
            if (!this.ready) {
              haxe.Timer.delay($bind(this, this.tryReady), 100);
            }
          },
          __class__: com.wiris.js.JsPluginTools,
        };
        var haxe = haxe || {};
        haxe.Log = function() {};
        haxe.Log.__name__ = true;
        haxe.Log.trace = function(e, t) {
          js.Boot.__trace(e, t);
        };
        haxe.Log.clear = function() {
          js.Boot.__clear_trace();
        };
        haxe.Md5 = function() {};
        haxe.Md5.__name__ = true;
        haxe.Md5.encode = function(e) {
          return new haxe.Md5().doEncode(e);
        };
        haxe.Md5.prototype = {
          doEncode: function(e) {
            var t = this.str2blks(e);
            var n = 1732584193;
            var i = -271733879;
            var r = -1732584194;
            var a = 271733878;
            for (var o = 0; o < t.length; ) {
              var s = n;
              var l = i;
              var c = r;
              var u = a;
              n = this.ff(n, i, r, a, t[o], 7, -680876936);
              a = this.ff(a, n, i, r, t[o + 1], 12, -389564586);
              r = this.ff(r, a, n, i, t[o + 2], 17, 606105819);
              i = this.ff(i, r, a, n, t[o + 3], 22, -1044525330);
              n = this.ff(n, i, r, a, t[o + 4], 7, -176418897);
              a = this.ff(a, n, i, r, t[o + 5], 12, 1200080426);
              r = this.ff(r, a, n, i, t[o + 6], 17, -1473231341);
              i = this.ff(i, r, a, n, t[o + 7], 22, -45705983);
              n = this.ff(n, i, r, a, t[o + 8], 7, 1770035416);
              a = this.ff(a, n, i, r, t[o + 9], 12, -1958414417);
              r = this.ff(r, a, n, i, t[o + 10], 17, -42063);
              i = this.ff(i, r, a, n, t[o + 11], 22, -1990404162);
              n = this.ff(n, i, r, a, t[o + 12], 7, 1804603682);
              a = this.ff(a, n, i, r, t[o + 13], 12, -40341101);
              r = this.ff(r, a, n, i, t[o + 14], 17, -1502002290);
              i = this.ff(i, r, a, n, t[o + 15], 22, 1236535329);
              n = this.gg(n, i, r, a, t[o + 1], 5, -165796510);
              a = this.gg(a, n, i, r, t[o + 6], 9, -1069501632);
              r = this.gg(r, a, n, i, t[o + 11], 14, 643717713);
              i = this.gg(i, r, a, n, t[o], 20, -373897302);
              n = this.gg(n, i, r, a, t[o + 5], 5, -701558691);
              a = this.gg(a, n, i, r, t[o + 10], 9, 38016083);
              r = this.gg(r, a, n, i, t[o + 15], 14, -660478335);
              i = this.gg(i, r, a, n, t[o + 4], 20, -405537848);
              n = this.gg(n, i, r, a, t[o + 9], 5, 568446438);
              a = this.gg(a, n, i, r, t[o + 14], 9, -1019803690);
              r = this.gg(r, a, n, i, t[o + 3], 14, -187363961);
              i = this.gg(i, r, a, n, t[o + 8], 20, 1163531501);
              n = this.gg(n, i, r, a, t[o + 13], 5, -1444681467);
              a = this.gg(a, n, i, r, t[o + 2], 9, -51403784);
              r = this.gg(r, a, n, i, t[o + 7], 14, 1735328473);
              i = this.gg(i, r, a, n, t[o + 12], 20, -1926607734);
              n = this.hh(n, i, r, a, t[o + 5], 4, -378558);
              a = this.hh(a, n, i, r, t[o + 8], 11, -2022574463);
              r = this.hh(r, a, n, i, t[o + 11], 16, 1839030562);
              i = this.hh(i, r, a, n, t[o + 14], 23, -35309556);
              n = this.hh(n, i, r, a, t[o + 1], 4, -1530992060);
              a = this.hh(a, n, i, r, t[o + 4], 11, 1272893353);
              r = this.hh(r, a, n, i, t[o + 7], 16, -155497632);
              i = this.hh(i, r, a, n, t[o + 10], 23, -1094730640);
              n = this.hh(n, i, r, a, t[o + 13], 4, 681279174);
              a = this.hh(a, n, i, r, t[o], 11, -358537222);
              r = this.hh(r, a, n, i, t[o + 3], 16, -722521979);
              i = this.hh(i, r, a, n, t[o + 6], 23, 76029189);
              n = this.hh(n, i, r, a, t[o + 9], 4, -640364487);
              a = this.hh(a, n, i, r, t[o + 12], 11, -421815835);
              r = this.hh(r, a, n, i, t[o + 15], 16, 530742520);
              i = this.hh(i, r, a, n, t[o + 2], 23, -995338651);
              n = this.ii(n, i, r, a, t[o], 6, -198630844);
              a = this.ii(a, n, i, r, t[o + 7], 10, 1126891415);
              r = this.ii(r, a, n, i, t[o + 14], 15, -1416354905);
              i = this.ii(i, r, a, n, t[o + 5], 21, -57434055);
              n = this.ii(n, i, r, a, t[o + 12], 6, 1700485571);
              a = this.ii(a, n, i, r, t[o + 3], 10, -1894986606);
              r = this.ii(r, a, n, i, t[o + 10], 15, -1051523);
              i = this.ii(i, r, a, n, t[o + 1], 21, -2054922799);
              n = this.ii(n, i, r, a, t[o + 8], 6, 1873313359);
              a = this.ii(a, n, i, r, t[o + 15], 10, -30611744);
              r = this.ii(r, a, n, i, t[o + 6], 15, -1560198380);
              i = this.ii(i, r, a, n, t[o + 13], 21, 1309151649);
              n = this.ii(n, i, r, a, t[o + 4], 6, -145523070);
              a = this.ii(a, n, i, r, t[o + 11], 10, -1120210379);
              r = this.ii(r, a, n, i, t[o + 2], 15, 718787259);
              i = this.ii(i, r, a, n, t[o + 9], 21, -343485551);
              n = this.addme(n, s);
              i = this.addme(i, l);
              r = this.addme(r, c);
              a = this.addme(a, u);
              o += 16;
            }
            return this.rhex(n) + this.rhex(i) + this.rhex(r) + this.rhex(a);
          },
          ii: function(e, t, n, i, r, a, o) {
            return this.cmn(this.bitXOR(n, this.bitOR(t, ~i)), e, t, r, a, o);
          },
          hh: function(e, t, n, i, r, a, o) {
            return this.cmn(this.bitXOR(this.bitXOR(t, n), i), e, t, r, a, o);
          },
          gg: function(e, t, n, i, r, a, o) {
            return this.cmn(
              this.bitOR(this.bitAND(t, i), this.bitAND(n, ~i)),
              e,
              t,
              r,
              a,
              o
            );
          },
          ff: function(e, t, n, i, r, a, o) {
            return this.cmn(
              this.bitOR(this.bitAND(t, n), this.bitAND(~t, i)),
              e,
              t,
              r,
              a,
              o
            );
          },
          cmn: function(e, t, n, i, r, a) {
            return this.addme(
              this.rol(this.addme(this.addme(t, e), this.addme(i, a)), r),
              n
            );
          },
          rol: function(e, t) {
            return (e << t) | (e >>> (32 - t));
          },
          str2blks: function(e) {
            var t = 1 + ((e.length + 8) >> 6);
            var n = new Array();
            var i = 0;
            for (var r = 16 * t; i < r; ) {
              n[(a = i++)] = 0;
            }
            for (var a = 0; a < e.length; ) {
              n[a >> 2] |=
                HxOverrides.cca(e, a) << (((8 * e.length + a) % 4) * 8);
              a++;
            }
            n[a >> 2] |= 128 << (((8 * e.length + a) % 4) * 8);
            var o = 8 * e.length;
            var s = 16 * t - 2;
            n[s] = 255 & o;
            n[s] |= ((o >>> 8) & 255) << 8;
            n[s] |= ((o >>> 16) & 255) << 16;
            n[s] |= ((o >>> 24) & 255) << 24;
            return n;
          },
          rhex: function(e) {
            var t = '';
            for (var n = 0; n < 4; ) {
              var i = n++;
              t +=
                '0123456789abcdef'.charAt((e >> (8 * i + 4)) & 15) +
                '0123456789abcdef'.charAt((e >> (8 * i)) & 15);
            }
            return t;
          },
          addme: function(e, t) {
            var n = (65535 & e) + (65535 & t);
            return (((e >> 16) + (t >> 16) + (n >> 16)) << 16) | (65535 & n);
          },
          bitAND: function(e, t) {
            return (((e >>> 1) & (t >>> 1)) << 1) | (1 & e & t);
          },
          bitXOR: function(e, t) {
            return (((e >>> 1) ^ (t >>> 1)) << 1) | ((1 & e) ^ (1 & t));
          },
          bitOR: function(e, t) {
            return (((e >>> 1) | (t >>> 1)) << 1) | ((1 & e) | (1 & t));
          },
          __class__: haxe.Md5,
        };
        haxe.Timer = function(e) {
          var t = this;
          this.id = window.setInterval(function() {
            t.run();
          }, e);
        };
        haxe.Timer.__name__ = true;
        haxe.Timer.delay = function(e, t) {
          var n = new haxe.Timer(t);
          n.run = function() {
            n.stop();
            e();
          };
          return n;
        };
        haxe.Timer.measure = function(e, t) {
          var n = haxe.Timer.stamp();
          var i = e();
          haxe.Log.trace(haxe.Timer.stamp() - n + 's', t);
          return i;
        };
        haxe.Timer.stamp = function() {
          return new Date().getTime() / 1e3;
        };
        haxe.Timer.prototype = {
          run: function() {},
          stop: function() {
            if (this.id != null) {
              window.clearInterval(this.id);
              this.id = null;
            }
          },
          __class__: haxe.Timer,
        };
        var js = js || {};
        var $_;
        js.Boot = function() {};
        js.Boot.__name__ = true;
        js.Boot.__unhtml = function(e) {
          return e
            .split('&')
            .join('&amp;')
            .split('<')
            .join('&lt;')
            .split('>')
            .join('&gt;');
        };
        js.Boot.__trace = function(e, t) {
          var n;
          var i = t != null ? t.fileName + ':' + t.lineNumber + ': ' : '';
          i += js.Boot.__string_rec(e, '');
          if (
            typeof document != 'undefined' &&
            (n = document.getElementById('haxe:trace')) != null
          ) {
            n.innerHTML += js.Boot.__unhtml(i) + '<br/>';
          } else if (typeof console != 'undefined' && console.log != null) {
            console.log(i);
          }
        };
        js.Boot.__clear_trace = function() {
          var e = document.getElementById('haxe:trace');
          if (e != null) {
            e.innerHTML = '';
          }
        };
        js.Boot.isClass = function(e) {
          return e.__name__;
        };
        js.Boot.isEnum = function(e) {
          return e.__ename__;
        };
        js.Boot.getClass = function(e) {
          return e.__class__;
        };
        js.Boot.__string_rec = function(e, t) {
          if (e == null) {
            return 'null';
          }
          if (t.length >= 5) {
            return '<...>';
          }
          var n = _typeof(e);
          switch ((n == 'function' &&
            (e.__name__ || e.__ename__) &&
            (n = 'object'),
          n)) {
            case 'object':
              if (e instanceof Array) {
                if (e.__enum__) {
                  if (e.length == 2) {
                    return e[0];
                  }
                  var i = e[0] + '(';
                  t += '\x09';
                  var r = 2;
                  for (var a = e.length; r < a; ) {
                    i +=
                      (o = r++) != 2
                        ? ',' + js.Boot.__string_rec(e[o], t)
                        : js.Boot.__string_rec(e[o], t);
                  }
                  return i + ')';
                }
                var o;
                var s = e.length;
                i = '[';
                t += '\x09';
                for (a = 0; a < s; ) {
                  var l = a++;
                  i += (l > 0 ? ',' : '') + js.Boot.__string_rec(e[l], t);
                }
                return (i += ']');
              }
              var c;
              try {
                c = e.toString;
              } catch (e) {
                return '???';
              }
              if (c != null && c != Object.toString) {
                var u = e.toString();
                if (u != '[object Object]') {
                  return u;
                }
              }
              var d = null;
              i = '{\n';
              t += '\x09';
              var m = e.hasOwnProperty != null;
              for (var d in e) {
                if (!m || !!e.hasOwnProperty(d)) {
                  if (
                    d != 'prototype' &&
                    d != '__class__' &&
                    d != '__super__' &&
                    d != '__interfaces__' &&
                    d != '__properties__'
                  ) {
                    if (i.length != 2) {
                      i += ', \n';
                    }
                    i += t + d + ' : ' + js.Boot.__string_rec(e[d], t);
                  }
                }
              }
              return (i += '\n' + (t = t.substring(1)) + '}');
            case 'function':
              return '<function>';
            case 'string':
              return e;
            default:
              return String(e);
          }
        };
        js.Boot.__interfLoop = function(e, t) {
          if (e == null) {
            return false;
          }
          if (e == t) {
            return true;
          }
          var n = e.__interfaces__;
          if (n != null) {
            var i = 0;
            for (var r = n.length; i < r; ) {
              var a = n[i++];
              if (a == t || js.Boot.__interfLoop(a, t)) {
                return true;
              }
            }
          }
          return js.Boot.__interfLoop(e.__super__, t);
        };
        js.Boot.__instanceof = function(e, t) {
          try {
            if (e instanceof t) {
              return t != Array || e.__enum__ == null;
            }
            if (js.Boot.__interfLoop(e.__class__, t)) {
              return true;
            }
          } catch (e) {
            if (t == null) {
              return false;
            }
          }
          switch (t) {
            case Int:
              return Math.ceil(e % 2147483648) === e;
            case Float:
              return typeof e == 'number';
            case Bool:
              return e === true || e === false;
            case String:
              return typeof e == 'string';
            case Dynamic:
              return true;
            default:
              return (
                e != null &&
                ((t == Class && e.__name__ != null) ||
                  ((t == Enum && e.__ename__ != null) || e.__enum__ == t))
              );
          }
        };
        js.Boot.__cast = function(e, t) {
          if (js.Boot.__instanceof(e, t)) {
            return e;
          }
          throw 'Cannot cast ' + Std.string(e) + ' to ' + Std.string(t);
        };
        js.Lib = function() {};
        js.Lib.__name__ = true;
        js.Lib.debug = function() {};
        js.Lib.alert = function(e) {
          alert(js.Boot.__string_rec(e, ''));
        };
        js.Lib.eval = function(code) {
          return eval(code);
        };
        js.Lib.setErrorHandler = function(e) {
          js.Lib.onerror = e;
        };
        if (Array.prototype.indexOf) {
          HxOverrides.remove = function(e, t) {
            var n = e.indexOf(t);
            return n != -1 && (e.splice(n, 1), true);
          };
        }
        Math.__name__ = ['Math'];
        Math.NaN = Number.NaN;
        Math.NEGATIVE_INFINITY = Number.NEGATIVE_INFINITY;
        Math.POSITIVE_INFINITY = Number.POSITIVE_INFINITY;
        Math.isFinite = function(e) {
          return isFinite(e);
        };
        Math.isNaN = function(e) {
          return isNaN(e);
        };
        String.prototype.__class__ = String;
        String.__name__ = true;
        Array.prototype.__class__ = Array;
        Array.__name__ = true;
        Date.prototype.__class__ = Date;
        Date.__name__ = ['Date'];
        var Int = { __name__: ['Int'] };
        var Dynamic = { __name__: ['Dynamic'] };
        var Float = Number;
        Float.__name__ = ['Float'];
        var Bool = Boolean;
        Bool.__ename__ = ['Bool'];
        var Class = { __name__: ['Class'] };
        var Enum = {};
        var Void = { __ename__: ['Void'] };
        if (typeof document != 'undefined') {
          js.Lib.document = document;
        }
        if (typeof window != 'undefined') {
          js.Lib.window = window;
          js.Lib.window.onerror = function(e, t, n) {
            var i = js.Lib.onerror;
            return i != null && i(e, [t + ':' + n]);
          };
        }
        com.wiris.js.JsPluginTools.main();
      })();
      delete Array.prototype.__class__;
    },
    function(e, t, n) {
      var i = n(4);
      if (typeof i == 'string') {
        i = [[e.i, i, '']];
      }
      var r = { hmr: true, transform: void 0, insertInto: void 0 };
      n(6)(i, r);
      if (i.locals) {
        e.exports = i.locals;
      }
    },
    function(e, t, n) {
      (e.exports = n(5)(false)).push([
        e.i,
        ".wrs_modal_overlay {\r\n  position: fixed;\r\n  font-family: arial, sans-serif;\r\n  top: 0;\r\n  right: 0;\r\n  left: 0;\r\n  bottom: 0;\r\n  background: rgba(0, 0, 0, 0.8);\r\n  z-index: 999998;\r\n  opacity: 0.65;\r\n  pointer-events: auto;\r\n}\r\n\r\n.wrs_modal_overlay.wrs_modal_ios {\r\n  visibility: hidden;\r\n  display: none;\r\n}\r\n\r\n.wrs_modal_overlay.wrs_modal_android {\r\n  visibility: hidden;\r\n  display: none;\r\n}\r\n\r\n.wrs_modal_overlay.wrs_modal_ios.moodle {\r\n  position: fixed;\r\n}\r\n\r\n.wrs_modal_overlay.wrs_modal_desktop.wrs_stack {\r\n  background: rgba(0, 0, 0, 0);\r\n  display: none;\r\n}\r\n\r\n.wrs_modal_overlay.wrs_modal_desktop.wrs_maximized {\r\n  background: rgba(0, 0, 0, 0.8);\r\n}\r\n\r\n.wrs_modal_overlay.wrs_modal_desktop.wrs_minimized {\r\n  background: rgba(0, 0, 0, 0);\r\n  display: none;\r\n}\r\n\r\n.wrs_modal_overlay.wrs_modal_desktop.wrs_closed {\r\n  background: rgba(0, 0, 0, 0);\r\n  display: none;\r\n}\r\n\r\n.wrs_modal_title {\r\n  color: #fff;\r\n  padding: 5px 0 5px 10px;\r\n  -moz-user-select: none;\r\n  -webkit-user-select: none;\r\n  -ms-user-select: none;\r\n  user-select: none;\r\n  text-align: left;\r\n}\r\n\r\n.wrs_modal_close_button {\r\n  float: right;\r\n  cursor: pointer;\r\n  color: #fff;\r\n  padding: 5px 10px 5px 0;\r\n  margin: 10px 7px 0 0;\r\n  background-repeat: no-repeat;\r\n}\r\n\r\n.wrs_modal_minimize_button {\r\n  float: right;\r\n  cursor: pointer;\r\n  color: #fff;\r\n  padding: 5px 10px 5px 0;\r\n  top: inherit;\r\n  margin: 10px 7px 0 0;\r\n}\r\n\r\n.wrs_modal_stack_button {\r\n  float: right;\r\n  cursor: pointer;\r\n  color: #fff;\r\n  margin: 10px 7px 0 0;\r\n  padding: 5px 10px 5px 0;\r\n  top: inherit;\r\n}\r\n\r\n.wrs_modal_stack_button.wrs_stack {\r\n  visibility: hidden;\r\n  margin: 0;\r\n  padding: 0;\r\n}\r\n\r\n.wrs_modal_stack_button.wrs_minimized {\r\n  visibility: hidden;\r\n  margin: 0;\r\n  padding: 0;\r\n}\r\n\r\n.wrs_modal_maximize_button {\r\n  float: right;\r\n  cursor: pointer;\r\n  color: #fff;\r\n  margin: 10px 7px 0 0;\r\n  padding: 5px 10px 5px 0;\r\n  top: inherit;\r\n}\r\n\r\n.wrs_modal_maximize_button.wrs_maximized {\r\n  visibility: hidden;\r\n  margin: 0;\r\n  padding: 0;\r\n}\r\n\r\n.wrs_modal_wrapper {\r\n  display: block;\r\n  margin: 6px;\r\n}\r\n\r\n.wrs_modal_title_bar {\r\n  display: block;\r\n  background-color: #778e9a;\r\n}\r\n\r\n.wrs_modal_dialogContainer {\r\n  border: none;\r\n  background: #fafafa;\r\n  z-index: 999999;\r\n}\r\n\r\n.wrs_modal_dialogContainer.wrs_modal_desktop {\r\n  font-size: 14px;\r\n}\r\n\r\n.wrs_modal_dialogContainer.wrs_modal_desktop.wrs_maximized {\r\n  position: fixed;\r\n}\r\n\r\n.wrs_modal_dialogContainer.wrs_modal_desktop.wrs_minimized {\r\n  position: fixed;\r\n  top: inherit;\r\n  margin: 0;\r\n  margin-right: 10px;\r\n}\r\n\r\n.wrs_modal_dialogContainer.wrs_closed {\r\n  visibility: hidden;\r\n  display: none;\r\n  opacity: 0;\r\n}\r\n\r\n\r\n/* Class that exists but hasn't got css properties defined\r\n.wrs_modal_dialogContainer.wrs_modal_desktop.wrs_minimized.wrs_drag {} */\r\n\r\n.wrs_modal_dialogContainer.wrs_modal_desktop.wrs_stack {\r\n  position: fixed;\r\n  bottom: 0;\r\n  right: 0;\r\n  box-shadow: rgba(0, 0, 0, 0.5) 0 2px 8px;\r\n}\r\n\r\n.wrs_modal_dialogContainer.wrs_drag {\r\n  box-shadow: rgba(0, 0, 0, 0.5) 0 2px 8px;\r\n}\r\n\r\n.wrs_modal_dialogContainer.wrs_modal_desktop.wrs_drag {\r\n  box-shadow: rgba(0, 0, 0, 0.5) 0 2px 8px;\r\n}\r\n\r\n.wrs_modal_dialogContainer.wrs_modal_android {\r\n  margin: auto;\r\n  position: fixed;\r\n  width: 99%;\r\n  height: 99%;\r\n  overflow: hidden;\r\n  transform: translate(50%, -50%);\r\n  top: 50%;\r\n  right: 50% !important;\r\n  position: fixed;\r\n}\r\n\r\n.wrs_modal_dialogContainer.wrs_modal_ios {\r\n  margin: auto;\r\n  position: fixed;\r\n  width: 100%;\r\n  height: 100%;\r\n  overflow: hidden;\r\n  transform: translate(50%, -50%);\r\n  top: 50%;\r\n  right: 50% !important;\r\n  position: fixed;\r\n}\r\n\r\n\r\n/* Class that exists but hasn't got css properties defined\r\n.wrs_content_container.wrs_maximized {} */\r\n\r\n.wrs_content_container.wrs_minimized {\r\n  display: none;\r\n}\r\n\r\n/* .wrs_editor {\r\n    flex-grow: 1;\r\n} */\r\n\r\n.wrs_content_container.wrs_modal_android {\r\n  width: 100%;\r\n  flex-grow: 1;\r\n  display: flex;\r\n  flex-direction: column;\r\n}\r\n\r\n.wrs_content_container.wrs_modal_android > div:first-child {\r\n  flex-grow: 1;\r\n}\r\n\r\n.wrs_content_container.wrs_modal_ios > div:first-child {\r\n  flex-grow: 1;\r\n}\r\n\r\n.wrs_content_container.wrs_modal_desktop > div:first-child {\r\n  flex-grow: 1;\r\n}\r\n\r\n.wrs_modal_wrapper.wrs_modal_android {\r\n  margin: auto;\r\n  display: flex;\r\n  flex-direction: column;\r\n  height: 100%;\r\n  width: 100%;\r\n}\r\n\r\n.wrs_content_container.wrs_modal_desktop {\r\n  width: 100%;\r\n  flex-grow: 1;\r\n  display: flex;\r\n  flex-direction: column;\r\n}\r\n\r\n.wrs_content_container.wrs_modal_ios {\r\n  width: 100%;\r\n  flex-grow: 1;\r\n  display: flex;\r\n  flex-direction: column;\r\n}\r\n\r\n.wrs_modal_wrapper.wrs_modal_ios {\r\n  margin: auto;\r\n  display: flex;\r\n  flex-direction: column;\r\n  height: 100%;\r\n  width: 100%;\r\n}\r\n\r\n.wrs_virtual_keyboard {\r\n  height: 100%;\r\n  width: 100%;\r\n  top: 0;\r\n  left: 50%;\r\n  transform: translate(-50%, 0%);\r\n}\r\n\r\n@media all and (orientation: portrait) {\r\n  .wrs_modal_dialogContainer.wrs_modal_mobile {\r\n    width: 100vmin;\r\n    height: 100vmin;\r\n    margin: auto;\r\n    border-width: 0;\r\n  }\r\n\r\n  .wrs_modal_wrapper.wrs_modal_mobile {\r\n    width: 100vmin;\r\n    height: 100vmin;\r\n    margin: auto;\r\n  }\r\n}\r\n\r\n@media all and (orientation: landscape) {\r\n  .wrs_modal_dialogContainer.wrs_modal_mobile {\r\n    width: 100vmin;\r\n    height: 100vmin;\r\n    margin: auto;\r\n    border-width: 0;\r\n  }\r\n\r\n  .wrs_modal_wrapper.wrs_modal_mobile {\r\n    width: 100vmin;\r\n    height: 100vmin;\r\n    margin: auto;\r\n  }\r\n}\r\n\r\n.wrs_modal_dialogContainer.wrs_modal_badStock {\r\n  width: 100%;\r\n  height: 280px;\r\n  margin: 0 auto;\r\n  border-width: 0;\r\n}\r\n\r\n.wrs_modal_wrapper.wrs_modal_badStock {\r\n  width: 100%;\r\n  height: 280px;\r\n  margin: 0 auto;\r\n  border-width: 0;\r\n}\r\n\r\n.wrs_noselect {\r\n  -moz-user-select: none;\r\n  -khtml-user-select: none;\r\n  -webkit-user-select: none;\r\n  -ms-user-select: none;\r\n  user-select: none;\r\n}\r\n\r\n.wrs_bottom_right_resizer {\r\n  width: 10px;\r\n  height: 10px;\r\n  color: #778e9a;\r\n  position: absolute;\r\n  right: 4px;\r\n  bottom: 8px;\r\n  cursor: se-resize;\r\n  -moz-user-select: none;\r\n  -webkit-user-select: none;\r\n  -ms-user-select: none;\r\n  user-select: none;\r\n}\r\n\r\n.wrs_bottom_left_resizer {\r\n  width: 15px;\r\n  height: 15px;\r\n  color: #778e9a;\r\n  position: absolute;\r\n  left: 0;\r\n  top: 0;\r\n  cursor: se-resize;\r\n}\r\n\r\n.wrs_modal_controls {\r\n  height: 42px;\r\n  margin: 3px 0;\r\n  overflow: hidden;\r\n  line-height: normal;\r\n}\r\n\r\n.wrs_modal_links {\r\n  margin: 10px auto;\r\n  margin-bottom: 0;\r\n  font-family: arial, sans-serif;\r\n  padding: 6px;\r\n  display: inline;\r\n  float: right;\r\n  text-align: right;\r\n}\r\n\r\n.wrs_modal_links > a {\r\n  text-decoration: none;\r\n  color: #778e9a;\r\n  font-size: 16px;\r\n}\r\n\r\n.wrs_modal_button_cancel,\r\n.wrs_modal_button_cancel:hover,\r\n.wrs_modal_button_cancel:visited,\r\n.wrs_modal_button_cancel:active,\r\n.wrs_modal_button_cancel:focus {\r\n  min-width: 80px;\r\n  font-size: 14px;\r\n  border-radius: 3px;\r\n  border: 1px solid #778e9a;\r\n  padding: 6px 8px;\r\n  margin: 10px auto;\r\n  margin-left: 5px;\r\n  margin-bottom: 0;\r\n  cursor: pointer;\r\n  font-family: arial, sans-serif;\r\n  background-color: #ddd;\r\n  height: 32px;\r\n}\r\n\r\n.wrs_modal_button_accept,\r\n.wrs_modal_button_accept:hover,\r\n.wrs_modal_button_accept:visited,\r\n.wrs_modal_button_accept:active,\r\n.wrs_modal_button_accept:focus {\r\n  min-width: 80px;\r\n  font-size: 14px;\r\n  border-radius: 3px;\r\n  border: 1px solid #778e9a;\r\n  padding: 6px 8px;\r\n  margin: 10px auto;\r\n  margin-right: 5px;\r\n  margin-bottom: 0;\r\n  color: #fff;\r\n  background: #778e9a;\r\n  cursor: pointer;\r\n  font-family: arial, sans-serif;\r\n  height: 32px;\r\n}\r\n\r\n.wrs_editor_vertical_bar {\r\n  height: 20px;\r\n  float: right;\r\n  background: none;\r\n  width: 20px;\r\n  cursor: pointer;\r\n}\r\n\r\n.wrs_modal_buttons_container {\r\n  display: inline;\r\n  float: left;\r\n}\r\n\r\n.wrs_modal_buttons_container.wrs_modalAndroid {\r\n  padding-left: 6px;\r\n}\r\n\r\n.wrs_modal_buttons_container.wrs_modalDesktop {\r\n  padding-left: 0;\r\n}\r\n\r\n.wrs_modal_buttons_container > button {\r\n  line-height: normal;\r\n  background-image: none;\r\n}\r\n\r\n.wrs_modal_wrapper {\r\n  margin: 6px;\r\n  display: flex;\r\n  flex-direction: column;\r\n}\r\n\r\n.wrs_modal_wrapper.wrs_modal_desktop.wrs_minimized {\r\n  display: none;\r\n}\r\n\r\n@media only screen and (max-device-width: 480px) and (orientation: portrait) {\r\n  #wrs_modal_wrapper {\r\n    width: 140%;\r\n  }\r\n}\r\n\r\n.wrs_popupmessage_overlay_envolture {\r\n  display: none;\r\n  width: 100%;\r\n}\r\n\r\n.wrs_popupmessage_overlay {\r\n  position: absolute;\r\n  width: 100%;\r\n  height: 100%;\r\n  top: 0;\r\n  left: 0;\r\n  right: 0;\r\n  bottom: 0;\r\n  background-color: rgba(0, 0, 0, 0.5);\r\n  z-index: 4;\r\n  cursor: pointer;\r\n}\r\n\r\n.wrs_popupmessage_panel {\r\n  top: 50%;\r\n  left: 50%;\r\n  transform: translate(-50%, -50%);\r\n  position: absolute;\r\n  background: white;\r\n  max-width: 500px;\r\n  width: 75%;\r\n  border-radius: 2px;\r\n  padding: 20px;\r\n  font-family: sans-serif;\r\n  font-size: 15px;\r\n  text-align: left;\r\n  color: #2e2e2e;\r\n  z-index: 5;\r\n  max-height: 75%;\r\n  overflow: auto;\r\n}\r\n\r\n.wrs_popupmessage_button_area {\r\n  margin: 10px 0 0 0;\r\n}\r\n\r\n.wrs_panelContainer * {\r\n  border: 0;\r\n}\r\n\r\n.wrs_button_cancel,\r\n.wrs_button_cancel:hover,\r\n.wrs_button_cancel:visited,\r\n.wrs_button_cancel:active,\r\n.wrs_button_cancel:focus {\r\n  min-width: 80px;\r\n  font-size: 14px;\r\n  border-radius: 3px;\r\n  border: 1px solid #778e9a;\r\n  padding: 6px 8px;\r\n  margin: 10px auto;\r\n  margin-left: 5px;\r\n  margin-bottom: 0;\r\n  cursor: pointer;\r\n  font-family: arial, sans-serif;\r\n  background-color: #ddd;\r\n  background-image: none;\r\n  height: 32px;\r\n}\r\n\r\n.wrs_button_accept,\r\n.wrs_button_accept:hover,\r\n.wrs_button_accept:visited,\r\n.wrs_button_accept:active,\r\n.wrs_button_accept:focus {\r\n  min-width: 80px;\r\n  font-size: 14px;\r\n  border-radius: 3px;\r\n  border: 1px solid #778e9a;\r\n  padding: 6px 8px;\r\n  margin: 10px auto;\r\n  margin-right: 5px;\r\n  margin-bottom: 0;\r\n  color: #fff;\r\n  background: #778e9a;\r\n  cursor: pointer;\r\n  font-family: arial, sans-serif;\r\n  height: 32px;\r\n}\r\n\r\n.wrs_editor button {\r\n  box-shadow: none;\r\n}\r\n\r\n.wrs_editor .wrs_header button {\r\n  border-bottom: none;\r\n  border-bottom-left-radius: 0;\r\n  border-bottom-right-radius: 0;\r\n}\r\n\r\n.wrs_modal_overlay.wrs_modal_desktop.wrs_stack.wrs_overlay_active {\r\n  display: block;\r\n}\r\n\r\n/* Fix selection in drupal style */\r\n.wrs_toolbar tr:focus {\r\n  background: none;\r\n}\r\n\r\n.wrs_toolbar tr:hover {\r\n  background: none;\r\n}\r\n\r\n/* End of fix drupal */\r\n.wrs_modal_rtl .wrs_modal_button_cancel {\r\n  margin-right: 5px;\r\n  margin-left: 0;\r\n}\r\n\r\n.wrs_modal_rtl .wrs_modal_button_accept {\r\n  margin-right: 0;\r\n  margin-left: 5px;\r\n}\r\n\r\n.wrs_modal_rtl .wrs_button_cancel {\r\n  margin-right: 5px;\r\n  margin-left: 0;\r\n}\r\n\r\n.wrs_modal_rtl .wrs_button_accept {\r\n  margin-right: 0;\r\n  margin-left: 5px;\r\n}\r\n",
        '',
      ]);
    },
    function(e, t) {
      e.exports = function(e) {
        var t = [];
        t.toString = function() {
          return this.map(function(t) {
            var n = (function(e, t) {
              var n = e[1] || '';
              var i = e[3];
              if (!i) {
                return n;
              }
              if (t && typeof btoa == 'function') {
                var r = (function() {
                  var e = i;
                  return (
                    '/*# sourceMappingURL=data:application/json;charset=utf-8;base64,' +
                    btoa(unescape(encodeURIComponent(JSON.stringify(e)))) +
                    ' */'
                  );
                })();
                var a = i.sources.map(function(e) {
                  return '/*# sourceURL=' + i.sourceRoot + e + ' */';
                });
                return [n]
                  .concat(a)
                  .concat([r])
                  .join('\n');
              }
              return [n].join('\n');
            })(t, e);
            if (t[2]) {
              return '@media ' + t[2] + '{' + n + '}';
            } else {
              return n;
            }
          }).join('');
        };
        t.i = function(e, n) {
          if (typeof e == 'string') {
            e = [[null, e, '']];
          }
          var i = {};
          for (var r = 0; r < this.length; r++) {
            var a = this[r][0];
            if (typeof a == 'number') {
              i[a] = true;
            }
          }
          for (r = 0; r < e.length; r++) {
            var o = e[r];
            if (typeof o[0] != 'number' || !i[o[0]]) {
              if (n && !o[2]) {
                o[2] = n;
              } else if (n) {
                o[2] = '(' + o[2] + ') and (' + n + ')';
              }
              t.push(o);
            }
          }
        };
        return t;
      };
    },
    function(e, t, n) {
      function u(e, t) {
        for (var n = 0; n < e.length; n++) {
          var r = e[n];
          var a = i[r.id];
          if (a) {
            a.refs++;
            for (var o = 0; o < a.parts.length; o++) {
              a.parts[o](r.parts[o]);
            }
          } else {
            var s = [];
            for (o = 0; o < r.parts.length; o++) {
              s.push(f(r.parts[o], t));
            }
            i[r.id] = { id: r.id, refs: 1, parts: s };
          }
        }
      }
      function d(e, t) {
        var n = [];
        var i = {};
        for (var r = 0; r < e.length; r++) {
          var a = e[r];
          var o = t.base ? a[0] + t.base : a[0];
          var s = { css: a[1], media: a[2], sourceMap: a[3] };
          if (i[o]) {
            i[o].parts.push(s);
          } else {
            n.push((i[o] = { id: o, parts: [s] }));
          }
        }
        return n;
      }
      function m(e, t) {
        var n = a(e.insertInto);
        if (!n) {
          throw new Error(
            "Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid."
          );
        }
        var i = l[l.length - 1];
        if (e.insertAt === 'top') {
          if (i) {
            if (i.nextSibling) {
              n.insertBefore(t, i.nextSibling);
            } else {
              n.appendChild(t);
            }
          } else {
            n.insertBefore(t, n.firstChild);
          }
          l.push(t);
        } else if (e.insertAt === 'bottom') {
          n.appendChild(t);
        } else {
          if (typeof e.insertAt != 'object' || !e.insertAt.before) {
            throw new Error(
              "[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n"
            );
          }
          var r = a(e.insertAt.before, n);
          n.insertBefore(t, r);
        }
      }
      function h(e) {
        if (e.parentNode === null) {
          return false;
        }
        e.parentNode.removeChild(e);
        var t = l.indexOf(e);
        if (t >= 0) {
          l.splice(t, 1);
        }
      }
      function g(e) {
        var t = document.createElement('style');
        if (e.attrs.type === void 0) {
          e.attrs.type = 'text/css';
        }
        if (e.attrs.nonce === void 0) {
          var i = n.nc;
          if (i) {
            e.attrs.nonce = i;
          }
        }
        p(t, e.attrs);
        m(e, t);
        return t;
      }
      function p(e, t) {
        Object.keys(t).forEach(function(n) {
          e.setAttribute(n, t[n]);
        });
      }
      function f(e, t) {
        var n;
        var i;
        var r;
        var a;
        if (t.transform && e.css) {
          if (
            !(a =
              typeof t.transform == 'function'
                ? t.transform(e.css)
                : t.transform.default(e.css))
          ) {
            return function() {};
          }
          e.css = a;
        }
        if (t.singleton) {
          var l = s++;
          n = o || (o = g(t));
          i = _.bind(null, n, l, false);
          r = _.bind(null, n, l, true);
        } else if (
          e.sourceMap &&
          typeof URL == 'function' &&
          typeof URL.createObjectURL == 'function' &&
          typeof URL.revokeObjectURL == 'function' &&
          typeof Blob == 'function' &&
          typeof btoa == 'function'
        ) {
          n = (function(e) {
            var t = document.createElement('link');
            if (e.attrs.type === void 0) {
              e.attrs.type = 'text/css';
            }
            e.attrs.rel = 'stylesheet';
            p(t, e.attrs);
            m(e, t);
            return t;
          })(t);
          i = function(e, t, n) {
            var i = n.css;
            var r = n.sourceMap;
            var a = t.convertToAbsoluteUrls === void 0 && r;
            if (t.convertToAbsoluteUrls || a) {
              i = c(i);
            }
            if (r) {
              i +=
                '\n/*# sourceMappingURL=data:application/json;base64,' +
                btoa(unescape(encodeURIComponent(JSON.stringify(r)))) +
                ' */';
            }
            var o = new Blob([i], { type: 'text/css' });
            var s = e.href;
            e.href = URL.createObjectURL(o);
            if (s) {
              URL.revokeObjectURL(s);
            }
          }.bind(null, n, t);
          r = function() {
            h(n);
            if (n.href) {
              URL.revokeObjectURL(n.href);
            }
          };
        } else {
          n = g(t);
          i = function(e, t) {
            var n = t.css;
            var i = t.media;
            if (i) {
              e.setAttribute('media', i);
            }
            if (e.styleSheet) {
              e.styleSheet.cssText = n;
            } else {
              while (e.firstChild) {
                e.removeChild(e.firstChild);
              }
              e.appendChild(document.createTextNode(n));
            }
          }.bind(null, n);
          r = function() {
            h(n);
          };
        }
        i(e);
        return function(t) {
          if (t) {
            if (
              t.css === e.css &&
              t.media === e.media &&
              t.sourceMap === e.sourceMap
            ) {
              return;
            }
            i((e = t));
          } else {
            r();
          }
        };
      }
      function _(e, t, n, i) {
        var r = n ? '' : i.css;
        if (e.styleSheet) {
          e.styleSheet.cssText = v(t, r);
        } else {
          var a = document.createTextNode(r);
          var o = e.childNodes;
          if (o[t]) {
            e.removeChild(o[t]);
          }
          if (o.length) {
            e.insertBefore(a, o[t]);
          } else {
            e.appendChild(a);
          }
        }
      }
      var i = {};
      var r = (function() {
        var e = function() {
          return window && document && document.all && !window.atob;
        };
        var t;
        return function() {
          if (t === void 0) {
            t = e.apply(this, arguments);
          }
          return t;
        };
      })();
      var a = (function(e) {
        var t = {};
        return function(e, n) {
          if (typeof e == 'function') {
            return e();
          }
          if (t[e] === void 0) {
            var i = function(e, t) {
              if (t) {
                return t.querySelector(e);
              } else {
                return document.querySelector(e);
              }
            }.call(this, e, n);
            if (
              window.HTMLIFrameElement &&
              i instanceof window.HTMLIFrameElement
            ) {
              try {
                i = i.contentDocument.head;
              } catch (e) {
                i = null;
              }
            }
            t[e] = i;
          }
          return t[e];
        };
      })();
      var o = null;
      var s = 0;
      var l = [];
      var c = n(7);
      e.exports = function(e, t) {
        if (
          typeof DEBUG != 'undefined' &&
          DEBUG &&
          typeof document != 'object'
        ) {
          throw new Error(
            'The style-loader cannot be used in a non-browser environment'
          );
        }
        (t = t || {}).attrs = typeof t.attrs == 'object' ? t.attrs : {};
        if (!t.singleton && typeof t.singleton != 'boolean') {
          t.singleton = r();
        }
        if (!t.insertInto) {
          t.insertInto = 'head';
        }
        if (!t.insertAt) {
          t.insertAt = 'bottom';
        }
        var n = d(e, t);
        u(n, t);
        return function(e) {
          var r = [];
          for (var a = 0; a < n.length; a++) {
            var o = n[a];
            (s = i[o.id]).refs--;
            r.push(s);
          }
          if (e) {
            u(d(e, t), t);
          }
          for (a = 0; a < r.length; a++) {
            var s;
            if ((s = r[a]).refs === 0) {
              for (var l = 0; l < s.parts.length; l++) {
                s.parts[l]();
              }
              delete i[s.id];
            }
          }
        };
      };
      var v = (function() {
        var e = [];
        return function(t, n) {
          e[t] = n;
          return e.filter(Boolean).join('\n');
        };
      })();
    },
    function(e, t) {
      e.exports = function(e) {
        var t = typeof window != 'undefined' && window.location;
        if (!t) {
          throw new Error('fixUrls requires window.location');
        }
        if (!e || typeof e != 'string') {
          return e;
        }
        var n = t.protocol + '//' + t.host;
        var i = n + t.pathname.replace(/\/[^\/]*$/, '/');
        return e.replace(
          /url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi,
          function(e, t) {
            var r;
            var a = t
              .trim()
              .replace(/^"(.*)"$/, function(e, t) {
                return t;
              })
              .replace(/^'(.*)'$/, function(e, t) {
                return t;
              });
            if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(a)) {
              return e;
            } else {
              r =
                a.indexOf('//') === 0
                  ? a
                  : a.indexOf('/') === 0 ? n + a : i + a.replace(/^\.\//, '');
              return 'url(' + JSON.stringify(r) + ')';
            }
          }
        );
      };
    },
    function(e, t, n) {
      'use strict';
      function i(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function a(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function s(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function c(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function d(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function h(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function p(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function _(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function y(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function x(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function A(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function M(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function j(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function S(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function O(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function B(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function D(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function Y(e, t) {
        return (
          (function(e) {
            if (Array.isArray(e)) {
              return e;
            }
          })(e) ||
          (function(e, t) {
            if (
              !(Symbol.iterator in Object(e)) &&
              Object.prototype.toString.call(e) !== '[object Arguments]'
            ) {
              return;
            }
            var n = [];
            var i = true;
            var r = false;
            var a = void 0;
            try {
              var o;
              for (
                var s = e[Symbol.iterator]();
                !(i = (o = s.next()).done) &&
                (n.push(o.value), !t || n.length !== t);
                i = true
              ) {}
            } catch (e) {
              r = true;
              a = e;
            } finally {
              try {
                if (!i && s.return != null) {
                  s.return();
                }
              } finally {
                if (r) {
                  throw a;
                }
              }
            }
            return n;
          })(e, t) ||
          (function() {
            throw new TypeError(
              'Invalid attempt to destructure non-iterable instance'
            );
          })()
        );
      }
      function Q(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function $(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function ce(e, t) {
        if (!(e instanceof t)) {
          throw new TypeError('Cannot call a class as a function');
        }
      }
      function ue(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function de(e, t, n) {
        if (t) {
          ue(e.prototype, t);
        }
        if (n) {
          ue(e, n);
        }
        return e;
      }
      function he(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function fe(e) {
        return (fe =
          typeof Symbol == 'function' && typeof Symbol.iterator == 'symbol'
            ? function(e) {
                return typeof e;
              }
            : function(e) {
                if (
                  e &&
                  typeof Symbol == 'function' &&
                  e.constructor === Symbol &&
                  e !== Symbol.prototype
                ) {
                  return 'symbol';
                } else {
                  return typeof e;
                }
              })(e);
      }
      function ve(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      function _e(e, t, n) {
        return (_e =
          typeof Reflect != 'undefined' && Reflect.get
            ? Reflect.get
            : function(e, t, n) {
                var i = (function(e, t) {
                  while (
                    !Object.prototype.hasOwnProperty.call(e, t) &&
                    (e = we(e)) !== null
                  ) {}
                  return e;
                })(e, t);
                if (i) {
                  var r = Object.getOwnPropertyDescriptor(i, t);
                  if (r.get) {
                    return r.get.call(n);
                  } else {
                    return r.value;
                  }
                }
              })(e, t, n || e);
      }
      function be(e, t) {
        return (be =
          Object.setPrototypeOf ||
          function(e, t) {
            e.__proto__ = t;
            return e;
          })(e, t);
      }
      function ye(e) {
        return function() {
          var t;
          var n = we(e);
          if (
            (function() {
              if (typeof Reflect == 'undefined' || !Reflect.construct) {
                return false;
              }
              if (Reflect.construct.sham) {
                return false;
              }
              if (typeof Proxy == 'function') {
                return true;
              }
              try {
                Date.prototype.toString.call(
                  Reflect.construct(Date, [], function() {})
                );
                return true;
              } catch (e) {
                return false;
              }
            })()
          ) {
            var i = we(this).constructor;
            t = Reflect.construct(n, arguments, i);
          } else {
            t = n.apply(this, arguments);
          }
          return (function(e, t) {
            if (t && (fe(t) === 'object' || typeof t == 'function')) {
              return t;
            }
            return (function(e) {
              if (e === void 0) {
                throw new ReferenceError(
                  "this hasn't been initialised - super() hasn't been called"
                );
              }
              return e;
            })(e);
          })(this, t);
        };
      }
      function we(e) {
        return (we = Object.setPrototypeOf
          ? Object.getPrototypeOf
          : function(e) {
              return e.__proto__ || Object.getPrototypeOf(e);
            })(e);
      }
      function ke(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          i.enumerable = i.enumerable || false;
          i.configurable = true;
          if ('value' in i) {
            i.writable = true;
          }
          Object.defineProperty(e, i.key, i);
        }
      }
      n.r(t);
      var r = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
        }
        (function(e, t, n) {
          if (t) {
            i(e.prototype, t);
          }
          if (n) {
            i(e, n);
          }
        })(e, null, [
          {
            key: 'safeXmlCharactersEntities',
            get: function() {
              return {
                tagOpener: '&laquo;',
                tagCloser: '&raquo;',
                doubleQuote: '&uml;',
                realDoubleQuote: '&quot;',
              };
            },
          },
          {
            key: 'safeBadBlackboardCharacters',
            get: function() {
              return {
                ltElement: '\xABmo\xBB<\xAB/mo\xBB',
                gtElement: '\xABmo\xBB>\xAB/mo\xBB',
                ampElement: '\xABmo\xBB&\xAB/mo\xBB',
              };
            },
          },
          {
            key: 'safeGoodBlackboardCharacters',
            get: function() {
              return {
                ltElement: '\xABmo\xBB\xA7lt;\xAB/mo\xBB',
                gtElement: '\xABmo\xBB\xA7gt;\xAB/mo\xBB',
                ampElement: '\xABmo\xBB\xA7amp;\xAB/mo\xBB',
              };
            },
          },
          {
            key: 'xmlCharacters',
            get: function() {
              return {
                id: 'xmlCharacters',
                tagOpener: '<',
                tagCloser: '>',
                doubleQuote: '"',
                ampersand: '&',
                quote: "'",
              };
            },
          },
          {
            key: 'safeXmlCharacters',
            get: function() {
              return {
                id: 'safeXmlCharacters',
                tagOpener: '\xAB',
                tagCloser: '\xBB',
                doubleQuote: '\xA8',
                ampersand: '\xA7',
                quote: '`',
                realDoubleQuote: '\xA8',
              };
            },
          },
        ]);
        return e;
      })();
      var o = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
        }
        (function(e, t, n) {
          if (t) {
            a(e.prototype, t);
          }
          if (n) {
            a(e, n);
          }
        })(e, null, [
          {
            key: 'isMathmlInAttribute',
            value: function(e, t) {
              var n = '[\\s]*('.concat(
                '"[^"]*"|\'[^\']*\'',
                ')[\\s]*=[\\s]*[\\w-]+[\\s]*'
              );
              var i = "('".concat(n, "')*");
              var r = '^'
                .concat('[\'"][\\s]*=[\\s]*[\\w-]+')
                .concat(i, '[\\s]+gmi<');
              var a = new RegExp(r);
              var o = e
                .substring(0, t)
                .split('')
                .reverse()
                .join('');
              return a.test(o);
            },
          },
          {
            key: 'safeXmlDecode',
            value: function(e) {
              var t = r.safeXmlCharactersEntities.tagOpener;
              var n = r.safeXmlCharactersEntities.tagCloser;
              var i = r.safeXmlCharactersEntities.doubleQuote;
              var a = r.safeXmlCharactersEntities.realDoubleQuote;
              e = (e = (e = (e = e.split(t).join(r.safeXmlCharacters.tagOpener))
                .split(n)
                .join(r.safeXmlCharacters.tagCloser))
                .split(i)
                .join(r.safeXmlCharacters.doubleQuote))
                .split(a)
                .join(r.safeXmlCharacters.realDoubleQuote);
              var o = r.safeBadBlackboardCharacters.ltElement;
              var s = r.safeBadBlackboardCharacters.gtElement;
              var l = r.safeBadBlackboardCharacters.ampElement;
              if ('_wrs_blackboard' in window && window._wrs_blackboard) {
                e = (e = (e = e
                  .split(o)
                  .join(r.safeGoodBlackboardCharacters.ltElement))
                  .split(s)
                  .join(r.safeGoodBlackboardCharacters.gtElement))
                  .split(l)
                  .join(r.safeGoodBlackboardCharacters.ampElement);
              }
              t = r.safeXmlCharacters.tagOpener;
              n = r.safeXmlCharacters.tagCloser;
              i = r.safeXmlCharacters.doubleQuote;
              a = r.safeXmlCharacters.realDoubleQuote;
              var c = r.safeXmlCharacters.ampersand;
              var u = r.safeXmlCharacters.quote;
              e = (e = (e = (e = (e = e
                .split(t)
                .join(r.xmlCharacters.tagOpener))
                .split(n)
                .join(r.xmlCharacters.tagCloser))
                .split(i)
                .join(r.xmlCharacters.doubleQuote))
                .split(c)
                .join(r.xmlCharacters.ampersand))
                .split(u)
                .join(r.xmlCharacters.quote);
              var d = '';
              var m = null;
              for (var h = 0; h < e.length; h += 1) {
                var g = e.charAt(h);
                if (m == null) {
                  if (g === '$') {
                    m = '';
                  } else {
                    d += g;
                  }
                } else if (g === ';') {
                  d += '&'.concat(m);
                  m = null;
                } else if (g.match(/([a-zA-Z0-9#._-] | '-')/)) {
                  m += g;
                } else {
                  d += '$'.concat(m);
                  m = null;
                  h -= 1;
                }
              }
              return d;
            },
          },
          {
            key: 'safeXmlEncode',
            value: function(e) {
              var t = r.xmlCharacters.tagOpener;
              var n = r.xmlCharacters.tagCloser;
              var i = r.xmlCharacters.doubleQuote;
              var a = r.xmlCharacters.ampersand;
              var o = r.xmlCharacters.quote;
              return (e = (e = (e = (e = (e = e
                .split(t)
                .join(r.safeXmlCharacters.tagOpener))
                .split(n)
                .join(r.safeXmlCharacters.tagCloser))
                .split(i)
                .join(r.safeXmlCharacters.doubleQuote))
                .split(a)
                .join(r.safeXmlCharacters.ampersand))
                .split(o)
                .join(r.safeXmlCharacters.quote));
            },
          },
          {
            key: 'mathMLEntities',
            value: function(e) {
              var t = '';
              for (var n = 0; n < e.length; n += 1) {
                var i = e.charAt(n);
                if (e.codePointAt(n) > 128) {
                  t += '&#'.concat(e.codePointAt(n), ';');
                  if (e.codePointAt(n) > 65535) {
                    n += 1;
                  }
                } else if (i === '&') {
                  var r = e.indexOf(';', n + 1);
                  if (r >= 0) {
                    var a = document.createElement('span');
                    a.innerHTML = e.substring(n, r + 1);
                    t += '&#'.concat(
                      w.fixedCharCodeAt(a.textContent || a.innerText, 0),
                      ';'
                    );
                    n = r;
                  } else {
                    t += i;
                  }
                } else {
                  t += i;
                }
              }
              return t;
            },
          },
          {
            key: 'addCustomEditorClassAttribute',
            value: function(e, t) {
              var n = '';
              var i = e.indexOf('<math');
              if (i === 0) {
                var r = e.indexOf('>');
                if (e.indexOf('class') === -1) {
                  n = ''.concat(e.substr(i, r), ' class="wrs_').concat(t, '">');
                  return (n += e.substr(r + 1, e.length));
                }
              }
              return e;
            },
          },
          {
            key: 'removeCustomEditorClassAttribute',
            value: function(e, t) {
              if (
                e.indexOf('class') === -1 ||
                e.indexOf('wrs_'.concat(t)) === -1
              ) {
                return e;
              } else if (e.indexOf('class="wrs_'.concat(t, '"')) === -1) {
                return e.replace('wrs_'.concat(t), '');
              } else {
                return e.replace('class="wrs_'.concat(t, '"'), '');
              }
            },
          },
          {
            key: 'addAnnotation',
            value: function(t, n, i) {
              var r = '';
              if (t.indexOf('<annotation') === -1) {
                if (e.isEmpty(t)) {
                  var o = t.indexOf('/>');
                  var s = t.indexOf('>');
                  var l = s === o ? o : s;
                  r = ''
                    .concat(
                      t.substring(0, l),
                      '><semantics><annotation encoding="'
                    )
                    .concat(i, '">')
                    .concat(n, '</annotation></semantics></math>');
                } else {
                  var c = t.indexOf('>') + 1;
                  var u = t.lastIndexOf('</math>');
                  var d = t.substring(c, u);
                  r = ''
                    .concat(t.substring(0, c), '<semantics>')
                    .concat(d, '<annotation encoding="')
                    .concat(i, '">')
                    .concat(n, '</annotation></semantics></math>');
                }
              } else {
                var a = t.indexOf('</semantics>');
                r = ''
                  .concat(t.substring(0, a), '<annotation encoding="')
                  .concat(i, '">')
                  .concat(n, '</annotation>')
                  .concat(t.substring(a));
              }
              return r;
            },
          },
          {
            key: 'removeAnnotation',
            value: function(t, n) {
              var i = t;
              var r = '<annotation encoding="'.concat(n, '">');
              var a = t.indexOf(r);
              if (a !== -1) {
                var o = false;
                for (var s = t.indexOf('<annotation'); s !== -1; ) {
                  if (s !== a) {
                    o = true;
                  }
                  s = t.indexOf('<annotation', s + 1);
                }
                if (o) {
                  var l =
                    t.indexOf('</annotation>', a) + '</annotation>'.length;
                  i = t.substring(0, a) + t.substring(l);
                } else {
                  i = e.removeSemantics(t);
                }
              }
              return i;
            },
          },
          {
            key: 'removeSemantics',
            value: function(e) {
              var t = e;
              var n = e.indexOf('<semantics>');
              if (n !== -1) {
                var i = e.indexOf('<annotation', n + '<semantics>'.length);
                if (i !== -1) {
                  t =
                    e.substring(0, n) +
                    e.substring(n + '<semantics>'.length, i) +
                    '</math>';
                }
              }
              return t;
            },
          },
          {
            key: 'removeSemanticsOcurrences',
            value: function(e) {
              var t =
                arguments.length > 1 && arguments[1] !== void 0
                  ? arguments[1]
                  : r.xmlCharacters;
              var n = ''.concat(t.tagOpener, 'math');
              var i = ''.concat(t.tagOpener, '/math').concat(t.tagCloser);
              var a = '/'.concat(t.tagCloser);
              var o = t.tagCloser;
              var s = ''.concat(t.tagOpener, 'semantics').concat(t.tagCloser);
              var l = ''.concat(t.tagOpener, 'annotation encoding=');
              var c = '';
              var u = e.indexOf(n);
              for (var d = 0; u !== -1; ) {
                c += e.substring(d, u);
                var m = e.indexOf(i, u);
                var h = e.indexOf(a, u);
                var g = e.indexOf(o, u);
                if (m === -1) {
                  if (h === g - 1) {
                    d = h;
                  }
                } else {
                  d = m;
                }
                var p = e.indexOf(s, u);
                if (p === -1) {
                  d = u;
                  u = e.indexOf(n, u + n.length);
                } else {
                  var f = e.substring(u, p);
                  var v = e.indexOf(l, u);
                  if (v === -1) {
                    d = u;
                    u = e.indexOf(n, u + n.length);
                  } else {
                    var _ = p + s.length;
                    c += f + e.substring(_, v) + i;
                    u = e.indexOf(n, u + n.length);
                    d += i.length;
                  }
                }
              }
              return (c += e.substring(d, e.length));
            },
          },
          {
            key: 'containClass',
            value: function(e, t) {
              var n = e.indexOf('class');
              if (n === -1) {
                return false;
              }
              var i = e.indexOf('>', n);
              return e.substring(n, i).indexOf(t) !== -1;
            },
          },
          {
            key: 'isEmpty',
            value: function(e) {
              var t = e.indexOf('>');
              var n = e.indexOf('/>');
              var i = false;
              if (n !== -1 && n === t - 1) {
                i = true;
              }
              if (!i) {
                var r = new RegExp('</(.+:)?math>').exec(e);
                if (r) {
                  i = t + 1 === r.index;
                }
              }
              return i;
            },
          },
          {
            key: 'encodeProperties',
            value: function(e) {
              return e.replace(/\w+=".*?"/g, function(e) {
                var t = e.indexOf('"');
                var n = e.substring(t + 1, e.length - 1);
                var i = w.htmlEntities(n);
                return ''.concat(e.substring(0, t + 1)).concat(i, '"');
              });
            },
          },
        ]);
        return e;
      })();
      var l = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
        }
        (function(e, t, n) {
          if (t) {
            s(e.prototype, t);
          }
          if (n) {
            s(e, n);
          }
        })(e, null, [
          {
            key: 'addConfiguration',
            value: function(t) {
              Object.assign(e.properties, t);
            },
          },
          {
            key: 'get',
            value: function(t) {
              if (Object.prototype.hasOwnProperty.call(e.properties, t)) {
                return e.properties[t];
              } else {
                return (
                  !!Object.prototype.hasOwnProperty.call(
                    e.properties,
                    '_wrs_conf_'
                  ) && e.properties['_wrs_conf_'.concat(t)]
                );
              }
            },
          },
          {
            key: 'set',
            value: function(t, n) {
              e.properties[t] = n;
            },
          },
          {
            key: 'update',
            value: function(t, n) {
              if (e.get(t)) {
                var i = Object.assign(e.get(t), n);
                e.set(t, i);
              } else {
                e.set(t, n);
              }
            },
          },
          {
            key: 'properties',
            get: function() {
              return e._properties;
            },
            set: function(t) {
              e._properties = t;
            },
          },
        ]);
        return e;
      })();
      l._properties = {};
      var u = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
          this.cache = [];
        }
        (function(e, t, n) {
          if (t) {
            c(e.prototype, t);
          }
          if (n) {
            c(e, n);
          }
        })(e, [
          {
            key: 'populate',
            value: function(e, t) {
              this.cache[e] = t;
            },
          },
          {
            key: 'get',
            value: function(e) {
              return (
                !!Object.prototype.hasOwnProperty.call(this.cache, e) &&
                this.cache[e]
              );
            },
          },
        ]);
        return e;
      })();
      var m = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
          this.listeners = [];
        }
        (function(e, t, n) {
          if (t) {
            d(e.prototype, t);
          }
          if (n) {
            d(e, n);
          }
        })(
          e,
          [
            {
              key: 'add',
              value: function(e) {
                this.listeners.push(e);
              },
            },
            {
              key: 'fire',
              value: function(e, t) {
                for (
                  var n = 0;
                  n < this.listeners.length && !t.cancelled;
                  n += 1
                ) {
                  if (this.listeners[n].eventName === e) {
                    this.listeners[n].callback(t);
                  }
                }
                return t.defaultPrevented;
              },
            },
          ],
          [
            {
              key: 'newListener',
              value: function(e, t) {
                var n = {};
                n.eventName = e;
                n.callback = t;
                return n;
              },
            },
          ]
        );
        return e;
      })();
      var g = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
        }
        (function(e, t, n) {
          if (t) {
            h(e.prototype, t);
          }
          if (n) {
            h(e, n);
          }
        })(e, null, [
          {
            key: 'addListener',
            value: function(t) {
              e.listeners.add(t);
            },
          },
          {
            key: 'fireEvent',
            value: function(t, n) {
              e.listeners.fire(t, n);
            },
          },
          {
            key: 'setServicePath',
            value: function(t, n) {
              e.servicePaths[t] = n;
            },
          },
          {
            key: 'getServicePath',
            value: function(t) {
              return e.servicePaths[t];
            },
          },
          {
            key: 'getServerURL',
            value: function() {
              var e = window.location.href.split('/');
              return ''.concat(e[0], '//').concat(e[2]);
            },
          },
          {
            key: 'init',
            value: function(t) {
              e.parameters = t;
              var n = e.createServiceURI('configurationjs');
              var i = e.createServiceURI('createimage');
              var r = e.createServiceURI('showimage');
              var a = e.createServiceURI('getmathml');
              var o = e.createServiceURI('service');
              if (e.parameters.URI.indexOf('/') === 0) {
                var s = e.getServerURL();
                n = s + n;
                r = s + r;
                i = s + i;
                a = s + a;
                o = s + o;
              }
              e.setServicePath('configurationjs', n);
              e.setServicePath('showimage', r);
              e.setServicePath('createimage', i);
              e.setServicePath('service', o);
              e.setServicePath('getmathml', a);
              e.setServicePath('configurationjs', n);
              e.listeners.fire('onInit', {});
            },
          },
          {
            key: 'getUrl',
            value: function(e, t) {
              var n = window.location
                .toString()
                .substr(0, window.location.toString().lastIndexOf('/') + 1);
              var i = w.createHttpRequest();
              if (i) {
                if (t === void 0 || t === void 0) {
                  i.open('GET', e, false);
                } else if (
                  e.substr(0, 1) === '/' ||
                  e.substr(0, 7) === 'http://' ||
                  e.substr(0, 8) === 'https://'
                ) {
                  i.open('POST', e, false);
                } else {
                  i.open('POST', n + e, false);
                }
                if (t !== void 0 && t) {
                  i.setRequestHeader(
                    'Content-type',
                    'application/x-www-form-urlencoded; charset=UTF-8'
                  );
                  i.send(w.httpBuildQuery(t));
                } else {
                  i.send(null);
                }
                return i.responseText;
              } else {
                return '';
              }
            },
          },
          {
            key: 'getService',
            value: function(t, n, i) {
              var r;
              if (i === true) {
                var a = n ? '?' + n : '';
                var o = ''.concat(e.getServicePath(t)).concat(a);
                r = e.getUrl(o);
              } else {
                var s = e.getServicePath(t);
                r = e.getUrl(s, n);
              }
              return r;
            },
          },
          {
            key: 'getServerLanguageFromService',
            value: function(e) {
              if (e.indexOf('.php') === -1) {
                if (e.indexOf('.aspx') === -1) {
                  if (e.indexOf('wirispluginengine') === -1) {
                    return 'java';
                  } else {
                    return 'ruby';
                  }
                } else {
                  return 'aspx';
                }
              } else {
                return 'php';
              }
            },
          },
          {
            key: 'createServiceURI',
            value: function(t) {
              var n = e.serverExtension();
              return w.concatenateUrl(e.parameters.URI, t) + n;
            },
          },
          {
            key: 'serverExtension',
            value: function() {
              if (e.parameters.server.indexOf('php') === -1) {
                if (e.parameters.server.indexOf('aspx') === -1) {
                  return '';
                } else {
                  return '.aspx';
                }
              } else {
                return '.php';
              }
            },
          },
          {
            key: 'listeners',
            get: function() {
              return e._listeners;
            },
          },
          {
            key: 'parameters',
            get: function() {
              return e._parameters;
            },
            set: function(t) {
              e._parameters = t;
            },
          },
          {
            key: 'servicePaths',
            get: function() {
              return e._servicePaths;
            },
            set: function(t) {
              e._servicePaths = t;
            },
          },
          {
            key: 'integrationPath',
            get: function() {
              return e._integrationPath;
            },
            set: function(t) {
              e._integrationPath = t;
            },
          },
        ]);
        return e;
      })();
      g._servicePaths = {};
      g._integrationPath = '';
      g._listeners = new m();
      g._parameters = {};
      var f = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
        }
        (function(e, t, n) {
          if (t) {
            p(e.prototype, t);
          }
          if (n) {
            p(e, n);
          }
        })(e, null, [
          {
            key: 'getLatexFromMathML',
            value: function(t) {
              var n = o.removeSemantics(t);
              var i = e.cache;
              var r = { service: 'mathml2latex', mml: n };
              var a = JSON.parse(g.getService('service', r));
              var s = '';
              if (a.status === 'ok') {
                s = a.result.text;
                var l = w.htmlEntities(s);
                var c = o.addAnnotation(t, l, 'LaTeX');
                i.populate(s, c);
              }
              return s;
            },
          },
          {
            key: 'getMathMLFromLatex',
            value: function(t, n) {
              var i = e.cache;
              if (e.cache.get(t)) {
                return e.cache.get(t);
              }
              var r = { service: 'latex2mathml', latex: t };
              if (n) {
                r.saveLatex = '';
              }
              var a;
              var s = JSON.parse(g.getService('service', r));
              if (s.status === 'ok') {
                var l = s.result.text;
                a =
                  (l = l
                    .split('\r')
                    .join('')
                    .split('\n')
                    .join(' ')).indexOf('semantics') === -1 &&
                  l.indexOf('annotation') === -1
                    ? (l = o.addAnnotation(l, t, 'LaTeX'))
                    : l;
                if (!i.get(t)) {
                  i.populate(t, l);
                }
              } else {
                a = '$$'.concat(t, '$$');
              }
              return a;
            },
          },
          {
            key: 'parseMathmlToLatex',
            value: function(t, n) {
              var i;
              var a;
              var s;
              var l = '';
              var c = ''.concat(n.tagOpener, 'math');
              var u = ''.concat(n.tagOpener, '/math').concat(n.tagCloser);
              var d = ''
                .concat(n.tagOpener, 'annotation encoding=')
                .concat(n.doubleQuote, 'LaTeX')
                .concat(n.doubleQuote)
                .concat(n.tagCloser);
              var m = ''.concat(n.tagOpener, '/annotation').concat(n.tagCloser);
              var h = t.indexOf(c);
              for (var g = 0; h !== -1; ) {
                l += t.substring(g, h);
                if ((g = t.indexOf(u, h)) === -1) {
                  g = t.length - 1;
                } else {
                  g += u.length;
                }
                if ((a = (i = t.substring(h, g)).indexOf(d)) === -1) {
                  l += i;
                } else {
                  a += d.length;
                  s = i.indexOf(m);
                  var p = i.substring(a, s);
                  if (n === r.safeXmlCharacters) {
                    p = o.safeXmlDecode(p);
                  }
                  l += '$$'.concat(p, '$$');
                  e.cache.populate(p, i);
                }
                h = t.indexOf(c, g);
              }
              return (l += t.substring(g, t.length));
            },
          },
          {
            key: 'getLatexFromTextNode',
            value: function(e, t, n) {
              function a(e, t, i) {
                for (var r = e.nodeValue.indexOf(i, t); r === -1; ) {
                  if (!(e = e.nextSibling)) {
                    return null;
                  }
                  r = e.nodeValue ? e.nodeValue.indexOf(n.close) : -1;
                }
                return { node: e, position: r };
              }
              function o(e, t, n, i) {
                if (e === n) {
                  return t <= i;
                }
                while (e && e !== n) {
                  e = e.nextSibling;
                }
                return e === n;
              }
              if (n === void 0 || n == null) {
                n = { open: '$$', close: '$$' };
              }
              var i;
              for (
                var r = e;
                r.previousSibling && r.previousSibling.nodeType === 3;

              ) {
                r = r.previousSibling;
              }
              var s;
              var l = { node: r, position: 0 };
              var c = n.open.length;
              do {
                if (
                  (i = a(l.node, l.position, n.open)) == null ||
                  o(e, t, i.node, i.position)
                ) {
                  return null;
                }
                if ((l = a(i.node, i.position + c, n.close)) == null) {
                  return null;
                }
                l.position += c;
              } while (o(l.node, l.position, e, t));
              if (i.node === l.node) {
                s = i.node.nodeValue.substring(i.position + c, l.position - c);
              } else {
                var u = i.position + c;
                s = i.node.nodeValue.substring(u, i.node.nodeValue.length);
                var d = i.node;
                do {
                  if ((d = d.nextSibling) === l.node) {
                    s += l.node.nodeValue.substring(0, l.position - c);
                  } else {
                    s += d.nodeValue ? d.nodeValue : '';
                  }
                } while (d !== l.node);
              }
              return {
                latex: s,
                startNode: i.node,
                startPosition: i.position,
                endNode: l.node,
                endPosition: l.position,
              };
            },
          },
          {
            key: 'cache',
            get: function() {
              return e._cache;
            },
            set: function(t) {
              e._cache = t;
            },
          },
        ]);
        return e;
      })();
      f._cache = new u();
      var v = n(0);
      var b = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
          throw new Error(
            'Static class StringManager can not be instantiated.'
          );
        }
        (function(e, t, n) {
          if (t) {
            _(e.prototype, t);
          }
          if (n) {
            _(e, n);
          }
        })(e, null, [
          {
            key: 'get',
            value: function(e) {
              var t = this.language;
              if (t && t.length > 2) {
                t = t.slice(0, 2);
              }
              if (!this.strings.hasOwnProperty(t)) {
                console.warn(
                  'Unknown language '.concat(t, ' set in StringManager.')
                );
                t = 'en';
              }
              if (this.strings[t].hasOwnProperty(e)) {
                return this.strings[t][e];
              } else {
                console.warn(
                  'Unknown key '
                    .concat(e, ' for language ')
                    .concat(t, ' in StringManager.')
                );
                return e;
              }
            },
          },
        ]);
        return e;
      })();
      b.strings = v;
      b.language = 'en';
      var w = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
        }
        (function(e, t, n) {
          if (t) {
            y(e.prototype, t);
          }
          if (n) {
            y(e, n);
          }
        })(e, null, [
          {
            key: 'fireEvent',
            value: function(e, t) {
              if (document.createEvent) {
                var n = document.createEvent('HTMLEvents');
                n.initEvent(t, true, true);
                return !e.dispatchEvent(n);
              }
              var i = document.createEventObject();
              return e.fireEvent('on'.concat(t), i);
            },
          },
          {
            key: 'addEvent',
            value: function(e, t, n) {
              if (e.addEventListener) {
                e.addEventListener(t, n, true);
              } else if (e.attachEvent) {
                e.attachEvent('on'.concat(t), n);
              }
            },
          },
          {
            key: 'removeEvent',
            value: function(e, t, n) {
              if (e.removeEventListener) {
                e.removeEventListener(t, n, true);
              } else if (e.detachEvent) {
                e.detachEvent('on'.concat(t), n);
              }
            },
          },
          {
            key: 'addElementEvents',
            value: function(t, n, i, r) {
              if (n) {
                e.addEvent(t, 'dblclick', function(e) {
                  var t = e || window.event;
                  var i = t.srcElement ? t.srcElement : t.target;
                  n(i, t);
                });
              }
              if (i) {
                e.addEvent(t, 'mousedown', function(e) {
                  var t = e || window.event;
                  var n = t.srcElement ? t.srcElement : t.target;
                  i(n, t);
                });
              }
              if (r) {
                e.addEvent(document, 'mouseup', function(e) {
                  var t = e || window.event;
                  var n = t.srcElement ? t.srcElement : t.target;
                  r(n, t);
                });
              }
            },
          },
          {
            key: 'addClass',
            value: function(t, n) {
              if (!e.containsClass(t, n)) {
                t.className += ' '.concat(n);
              }
            },
          },
          {
            key: 'containsClass',
            value: function(e, t) {
              if (e == null || !('className' in e)) {
                return false;
              }
              var n = e.className.split(' ');
              for (var i = n.length - 1; i >= 0; i -= 1) {
                if (n[i] === t) {
                  return true;
                }
              }
              return false;
            },
          },
          {
            key: 'removeClass',
            value: function(e, t) {
              var n = '';
              var i = e.className.split(' ');
              for (var r = 0; r < i.length; r += 1) {
                if (i[r] !== t) {
                  n += ''.concat(i[r], ' ');
                }
              }
              e.className = n.trim();
            },
          },
          {
            key: 'convertOldXmlinitialtextAttribute',
            value: function(e) {
              var t = 'value=';
              var n = e.indexOf('xmlinitialtext');
              var i = e.indexOf(t, n);
              var r = e.charAt(i + t.length);
              var a = i + t.length + 1;
              var o = e.indexOf(r, a);
              var s = e.substring(a, o);
              var l = s.split('\xAB').join('\xA7lt;');
              l = (l = (l = l.split('\xBB').join('\xA7gt;'))
                .split('&')
                .join('\xA7'))
                .split('\xA8')
                .join('\xA7quot;');
              return (e = e.split(s).join(l));
            },
          },
          {
            key: 'createElement',
            value: function(t, n, i) {
              var r;
              if (n === void 0) {
                n = {};
              }
              if (i === void 0) {
                i = document;
              }
              try {
                var a = '<'.concat(t);
                Object.keys(n).forEach(function(t) {
                  a += ' '.concat(t, '="').concat(e.htmlEntities(n[t]), '"');
                });
                a += '>';
                r = i.createElement(a);
              } catch (e) {
                r = i.createElement(t);
                Object.keys(n).forEach(function(e) {
                  r.setAttribute(e, n[e]);
                });
              }
              return r;
            },
          },
          {
            key: 'createObject',
            value: function(t, n) {
              if (n === void 0) {
                n = document;
              }
              t = (t = (t = (t = t
                .split('<applet ')
                .join('<span wirisObject="WirisApplet" ')
                .split('<APPLET ')
                .join('<span wirisObject="WirisApplet" '))
                .split('</applet>')
                .join('</span>')
                .split('</APPLET>')
                .join('</span>'))
                .split('<param ')
                .join('<br wirisObject="WirisParam" ')
                .split('<PARAM ')
                .join('<br wirisObject="WirisParam" '))
                .split('</param>')
                .join('</br>')
                .split('</PARAM>')
                .join('</br>');
              var i = e.createElement('div', {}, n);
              i.innerHTML = t;
              (function t() {
                var i = i;
                if (
                  i.getAttribute &&
                  i.getAttribute('wirisObject') === 'WirisParam'
                ) {
                  var r = {};
                  for (var a = 0; a < i.attributes.length; a += 1) {
                    if (i.attributes[a].nodeValue !== null) {
                      r[i.attributes[a].nodeName] = i.attributes[a].nodeValue;
                    }
                  }
                  var o = e.createElement('param', r, n);
                  if (o.NAME) {
                    o.name = o.NAME;
                    o.value = o.VALUE;
                  }
                  o.removeAttribute('wirisObject');
                  i.parentNode.replaceChild(o, i);
                } else if (
                  i.getAttribute &&
                  i.getAttribute('wirisObject') === 'WirisApplet'
                ) {
                  var s = {};
                  for (var l = 0; l < i.attributes.length; l += 1) {
                    if (i.attributes[l].nodeValue !== null) {
                      s[i.attributes[l].nodeName] = i.attributes[l].nodeValue;
                    }
                  }
                  var c = e.createElement('applet', s, n);
                  c.removeAttribute('wirisObject');
                  for (var u = 0; u < i.childNodes.length; u += 1) {
                    t(i.childNodes[u]);
                    if (i.childNodes[u].nodeName.toLowerCase() === 'param') {
                      c.appendChild(i.childNodes[u]);
                      u -= 1;
                    }
                  }
                  i.parentNode.replaceChild(c, i);
                } else {
                  for (var d = 0; d < i.childNodes.length; d += 1) {
                    t(i.childNodes[d]);
                  }
                }
              })();
              return i.firstChild;
            },
          },
          {
            key: 'createObjectCode',
            value: function(t) {
              if (t === void 0 || t === null) {
                return null;
              }
              if (t.nodeType === 1) {
                var n = '<'.concat(t.tagName);
                for (var i = 0; i < t.attributes.length; i += 1) {
                  if (t.attributes[i].specified) {
                    n += ' '
                      .concat(t.attributes[i].name, '="')
                      .concat(e.htmlEntities(t.attributes[i].value), '"');
                  }
                }
                if (t.childNodes.length > 0) {
                  n += '>';
                  for (var r = 0; r < t.childNodes.length; r += 1) {
                    n += e.createObject(t.childNodes[r]);
                  }
                  n += '</'.concat(t.tagName, '>');
                } else if (t.nodeName === 'DIV' || t.nodeName === 'SCRIPT') {
                  n += '></'.concat(t.tagName, '>');
                } else {
                  n += '/>';
                }
                return n;
              }
              if (t.nodeType === 3) {
                return e.htmlEntities(t.nodeValue);
              } else {
                return '';
              }
            },
          },
          {
            key: 'concatenateUrl',
            value: function(e, t) {
              var n = '';
              if (e.indexOf('/') !== e.length && t.indexOf('/') !== 0) {
                n = '/';
              }
              return (e + n + t).replace(/([^:]\/)\/+/g, '$1');
            },
          },
          {
            key: 'htmlEntities',
            value: function(e) {
              return e
                .split('&')
                .join('&amp;')
                .split('<')
                .join('&lt;')
                .split('>')
                .join('&gt;')
                .split('"')
                .join('&quot;');
            },
          },
          {
            key: 'htmlEntitiesDecode',
            value: function(e) {
              var t = document.createElement('textarea');
              t.innerHTML = e;
              return t.value;
            },
          },
          {
            key: 'createHttpRequest',
            value: function() {
              if (
                window.location
                  .toString()
                  .substr(0, window.location.toString().lastIndexOf('/') + 1)
                  .substr(0, 7) === 'file://'
              ) {
                throw b.get('exception_cross_site');
              }
              if (typeof XMLHttpRequest != 'undefined') {
                return new XMLHttpRequest();
              }
              try {
                return new ActiveXObject('Msxml2.XMLHTTP');
              } catch (e) {
                try {
                  return new ActiveXObject('Microsoft.XMLHTTP');
                } catch (e) {
                  return null;
                }
              }
            },
          },
          {
            key: 'httpBuildQuery',
            value: function(t) {
              var n = '';
              Object.keys(t).forEach(function(i) {
                if (t[i] != null) {
                  n += ''
                    .concat(e.urlEncode(i), '=')
                    .concat(e.urlEncode(t[i]), '&');
                }
              });
              if (n.substring(n.length - 1) === '&') {
                n = n.substring(0, n.length - 1);
              }
              return n;
            },
          },
          {
            key: 'propertiesToString',
            value: function(t) {
              var n = [];
              Object.keys(t).forEach(function(e) {
                if (Object.prototype.hasOwnProperty.call(t, e)) {
                  n.push(e);
                }
              });
              var i = n.length;
              for (var r = 0; r < i; r += 1) {
                for (var a = r + 1; a < i; a += 1) {
                  var o = n[r];
                  var s = n[a];
                  if (e.compareStrings(o, s) > 0) {
                    n[r] = s;
                    n[a] = o;
                  }
                }
              }
              var l = '';
              for (var c = 0; c < i; c += 1) {
                var u = n[c];
                l += u;
                l += '=';
                var d = t[u];
                l += d = (d = (d = (d = d.replace('\\', '\\\\')).replace(
                  '\n',
                  '\\n'
                )).replace('\r', '\\r')).replace('\x09', '\\t');
                l += '\n';
              }
              return l;
            },
          },
          {
            key: 'compareStrings',
            value: function(t, n) {
              var r = t.length;
              var a = n.length;
              var o = r > a ? a : r;
              for (var i = 0; i < o; i += 1) {
                var s = e.fixedCharCodeAt(t, i) - e.fixedCharCodeAt(n, i);
                if (s !== 0) {
                  return s;
                }
              }
              return t.length - n.length;
            },
          },
          {
            key: 'fixedCharCodeAt',
            value: function(e, t) {
              t = t || 0;
              var n;
              var i;
              var r = e.charCodeAt(t);
              if (r >= 55296 && r <= 56319) {
                n = r;
                i = e.charCodeAt(t + 1);
                if (Number.isNaN(i)) {
                  throw b.get('exception_high_surrogate');
                }
                return 1024 * (n - 55296) + (i - 56320) + 65536;
              }
              return (!(r >= 56320) || !(r <= 57343)) && r;
            },
          },
          {
            key: 'urlToAssArray',
            value: function(e) {
              var t;
              if ((t = e.indexOf('?')) > 0) {
                var n = e.substring(t + 1).split('&');
                var i = {};
                for (t = 0; t < n.length; t += 1) {
                  var r = n[t].split('=');
                  if (r.length > 1) {
                    i[r[0]] = decodeURIComponent(r[1].replace(/\+/g, ' '));
                  }
                }
                return i;
              }
              return {};
            },
          },
          {
            key: 'urlEncode',
            value: function(e) {
              return encodeURIComponent(e);
            },
          },
          {
            key: 'getWIRISImageOutput',
            value: function(t, n, i) {
              var r = e.createObject(t);
              if (
                r &&
                (r.className === l.get('imageClassName') ||
                  r.getAttribute(l.get('imageMathmlAttribute')))
              ) {
                if (!n) {
                  return t;
                }
                var a = r.getAttribute(l.get('imageMathmlAttribute'));
                var s = o.safeXmlDecode(a);
                if (!l.get('saveHandTraces')) {
                  s = o.removeAnnotation(s, 'application/json');
                }
                if (s == null) {
                  s = r.getAttribute('alt');
                }
                if (i) {
                  return o.safeXmlEncode(s);
                } else {
                  return s;
                }
              }
              return t;
            },
          },
          {
            key: 'getNodeLength',
            value: function(t) {
              if (t.nodeType === 3) {
                return t.nodeValue.length;
              }
              if (t.nodeType === 1) {
                var n = { IMG: 1, BR: 1 }[t.nodeName.toUpperCase()];
                if (n === void 0) {
                  n = 0;
                }
                for (var i = 0; i < t.childNodes.length; i += 1) {
                  n += e.getNodeLength(t.childNodes[i]);
                }
                return n;
              }
              return 0;
            },
          },
          {
            key: 'getSelectedItem',
            value: function(t, n, i) {
              var r;
              if (n) {
                (r = t.contentWindow).focus();
              } else {
                r = window;
                t.focus();
              }
              if (document.selection && !i) {
                var a = r.document.selection.createRange();
                if (a.parentElement) {
                  if (a.htmlText.length > 0) {
                    if (a.text.length === 0) {
                      return e.getSelectedItem(t, n, true);
                    } else {
                      return null;
                    }
                  }
                  r.document.execCommand('InsertImage', false, '#');
                  var o;
                  var s;
                  var l = a.parentElement();
                  if (l.nodeName.toUpperCase() !== 'IMG') {
                    a.pasteHTML(
                      '<span id="wrs_openEditorWindow_temporalObject"></span>'
                    );
                    l = r.document.getElementById(
                      'wrs_openEditorWindow_temporalObject'
                    );
                  }
                  if (l.nextSibling && l.nextSibling.nodeType === 3) {
                    o = l.nextSibling;
                    s = 0;
                  } else if (
                    l.previousSibling &&
                    l.previousSibling.nodeType === 3
                  ) {
                    s = (o = l.previousSibling).nodeValue.length;
                  } else {
                    o = r.document.createTextNode('');
                    l.parentNode.insertBefore(o, l);
                    s = 0;
                  }
                  l.parentNode.removeChild(l);
                  return { node: o, caretPosition: s };
                }
                if (a.length > 1) {
                  return null;
                } else {
                  return { node: a.item(0) };
                }
              }
              if (r.getSelection) {
                var c;
                var u = r.getSelection();
                try {
                  c = u.getRangeAt(0);
                } catch (e) {
                  c = r.document.createRange();
                }
                var d = c.startContainer;
                if (d.nodeType === 3) {
                  return { node: d, caretPosition: c.startOffset };
                }
                if (d !== c.endContainer) {
                  return null;
                }
                if (d.nodeType === 1) {
                  var m = c.startOffset;
                  if (d.childNodes[m]) {
                    return { node: d.childNodes[m] };
                  }
                }
              }
              return null;
            },
          },
          {
            key: 'getSelectedItemOnTextarea',
            value: function(e) {
              var t = document.createTextNode(e.value);
              var n = f.getLatexFromTextNode(t, e.selectionStart);
              if (n === null) {
                return null;
              } else {
                return {
                  node: t,
                  caretPosition: e.selectionStart,
                  startPosition: n.startPosition,
                  endPosition: n.endPosition,
                };
              }
            },
          },
          {
            key: 'getElementsByNameFromString',
            value: function(e, t, n) {
              var i = [];
              e = e.toLowerCase();
              t = t.toLowerCase();
              for (var r = e.indexOf('<'.concat(t, ' ')); r !== -1; ) {
                var a = void 0;
                a = n ? '>' : '</'.concat(t, '>');
                var o = e.indexOf(a, r);
                if (o === -1) {
                  o = r + 1;
                } else {
                  o += a.length;
                  i.push({ start: r, end: o });
                }
                r = e.indexOf('<'.concat(t, ' '), o);
              }
              return i;
            },
          },
          {
            key: 'decode64',
            value: function(e) {
              var t = '+'.charCodeAt(0);
              var n = '/'.charCodeAt(0);
              var i = '0'.charCodeAt(0);
              var r = 'a'.charCodeAt(0);
              var a = 'A'.charCodeAt(0);
              var o = '-'.charCodeAt(0);
              var s = '_'.charCodeAt(0);
              var l = e.charCodeAt(0);
              if (l === t || l === o) {
                return 62;
              } else if (l === n || l === s) {
                return 63;
              } else if (l < i) {
                return -1;
              } else if (l < i + 10) {
                return l - i + 26 + 26;
              } else if (l < a + 26) {
                return l - a;
              } else if (l < r + 26) {
                return l - r + 26;
              } else {
                return null;
              }
            },
          },
          {
            key: 'b64ToByteArray',
            value: function(t, n) {
              var i;
              if (t.length % 4 > 0) {
                throw new Error(
                  'Invalid string. Length must be a multiple of 4'
                );
              }
              var a;
              var s = [];
              var r =
                n ||
                ((a =
                  t.charAt(t.length - 2) === '='
                    ? 2
                    : t.charAt(t.length - 1) === '=' ? 1 : 0) > 0
                  ? t.length - 4
                  : t.length);
              for (var o = 0; o < r; o += 4) {
                i =
                  (e.decode64(t.charAt(o)) << 18) |
                  (e.decode64(t.charAt(o + 1)) << 12) |
                  (e.decode64(t.charAt(o + 2)) << 6) |
                  e.decode64(t.charAt(o + 3));
                s.push((i >> 16) & 255);
                s.push((i >> 8) & 255);
                s.push(255 & i);
              }
              if (a) {
                if (a === 2) {
                  i =
                    (e.decode64(t.charAt(o)) << 2) |
                    (e.decode64(t.charAt(o + 1)) >> 4);
                  s.push(255 & i);
                } else if (a === 1) {
                  i =
                    (e.decode64(t.charAt(o)) << 10) |
                    (e.decode64(t.charAt(o + 1)) << 4) |
                    (e.decode64(t.charAt(o + 2)) >> 2);
                  s.push((i >> 8) & 255);
                  s.push(255 & i);
                }
              }
              return s;
            },
          },
          {
            key: 'readInt32',
            value: function(e) {
              if (e.length < 4) {
                return false;
              }
              var t = e.splice(0, 4);
              return (t[0] << 24) | (t[1] << 16) | (t[2] << 8) | (t[3] << 0);
            },
          },
          {
            key: 'readByte',
            value: function(e) {
              return e.shift() << 0;
            },
          },
          {
            key: 'readBytes',
            value: function(e, t, n) {
              return e.splice(t, n);
            },
          },
          {
            key: 'updateTextArea',
            value: function(e, t) {
              if (e && t) {
                e.focus();
                if (e.selectionStart == null) {
                  document.selection.createRange().text = t;
                } else {
                  var n = e.selectionEnd;
                  var i = e.value.substring(0, e.selectionStart);
                  var r = e.value.substring(n, e.value.length);
                  e.value = i + t + r;
                  e.selectionEnd = n + t.length;
                }
              }
            },
          },
          {
            key: 'updateExistingTextOnTextarea',
            value: function(e, t, n, i) {
              e.focus();
              var r = e.value.substring(0, n);
              e.value = r + t + e.value.substring(i, e.value.length);
              e.selectionEnd = n + t.length;
            },
          },
          {
            key: 'addArgument',
            value: function(e, t, n) {
              var i = e.indexOf('?') > 0 ? '&' : '?';
              return ''.concat(e + i + t, '=').concat(n);
            },
          },
        ]);
        return e;
      })();
      var k = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
        }
        (function(e, t, n) {
          if (t) {
            x(e.prototype, t);
          }
          if (n) {
            x(e, n);
          }
        })(e, null, [
          {
            key: 'removeImgDataAttributes',
            value: function(e) {
              var t = [];
              var n = e.attributes;
              Object.keys(n).forEach(function(e) {
                var i = n[e];
                if (i.name.indexOf('data-') === 0) {
                  t.push(i.name);
                }
              });
              t.forEach(function(t) {
                e.removeAttribute(t);
              });
            },
          },
          {
            key: 'clone',
            value: function(e, t) {
              var n = l.get('imageCustomEditorName');
              if (!e.hasAttribute(n)) {
                t.removeAttribute(n);
              }
              [
                l.get('imageMathmlAttribute'),
                n,
                'alt',
                'height',
                'width',
                'style',
                'src',
                'role',
              ].forEach(function(n) {
                var i = e.getAttribute(n);
                if (i) {
                  t.setAttribute(n, i);
                }
              });
            },
          },
          {
            key: 'setImgSize',
            value: function(t, n, i) {
              var r;
              var a;
              var o;
              var s;
              if (i) {
                if (l.get('imageFormat') === 'svg') {
                  if (l.get('saveMode') === 'base64') {
                    a = t.src.substr(
                      t.src.indexOf('base64,') + 7,
                      t.src.length
                    );
                    s = '';
                    o = w.b64ToByteArray(a, a.length);
                    for (var c = 0; c < o.length; c += 1) {
                      s += String.fromCharCode(o[c]);
                    }
                    r = e.getMetricsFromSvgString(s);
                  } else {
                    r = e.getMetricsFromSvgString(n);
                  }
                } else {
                  a = t.src.substr(t.src.indexOf('base64,') + 7, t.src.length);
                  o = w.b64ToByteArray(a, 88);
                  r = e.getMetricsFromBytes(o);
                }
              } else {
                r = w.urlToAssArray(n);
              }
              var u = r.cw;
              if (u) {
                var d = r.ch;
                var m = r.cb;
                var h = r.dpi;
                if (h) {
                  u = 96 * u / h;
                  d = 96 * d / h;
                  m = 96 * m / h;
                }
                t.width = u;
                t.height = d;
                t.style.verticalAlign = '-'.concat(d - m, 'px');
              }
            },
          },
          {
            key: 'fixAfterResize',
            value: function(t) {
              t.removeAttribute('style');
              t.removeAttribute('width');
              t.removeAttribute('height');
              t.style.maxWidth = 'none';
              if (t.src.indexOf('data:image') === -1) {
                e.setImgSize(t, t.src);
              } else if (l.get('imageFormat') === 'svg') {
                var n = decodeURIComponent(t.src.substring(32, t.src.length));
                e.setImgSize(t, n, true);
              } else {
                var i = t.src.substring(22, t.src.length);
                e.setImgSize(t, i, true);
              }
            },
          },
          {
            key: 'getMetricsFromSvgString',
            value: function(e) {
              var t = e.indexOf('height="');
              var n = e.indexOf('"', t + 8, e.length);
              var i = e.substring(t + 8, n);
              t = e.indexOf('width="');
              n = e.indexOf('"', t + 7, e.length);
              var r = e.substring(t + 7, n);
              t = e.indexOf('wrs:baseline="');
              n = e.indexOf('"', t + 14, e.length);
              var a = e.substring(t + 14, n);
              if (r !== void 0) {
                var o = [];
                o.cw = r;
                o.ch = i;
                if (a !== void 0) {
                  o.cb = a;
                }
                return o;
              }
              return [];
            },
          },
          {
            key: 'getMetricsFromBytes',
            value: function(e) {
              var t;
              var n;
              var i;
              var r;
              var a;
              for (w.readBytes(e, 0, 8); e.length >= 4; ) {
                if ((i = w.readInt32(e)) === 1229472850) {
                  t = w.readInt32(e);
                  n = w.readInt32(e);
                  w.readInt32(e);
                  w.readByte(e);
                } else if (i === 1650545477) {
                  r = w.readInt32(e);
                } else if (i === 1883789683) {
                  a = w.readInt32(e);
                  a = Math.round(a / 39.37);
                  w.readInt32(e);
                  w.readByte(e);
                }
                w.readInt32(e);
              }
              if (t !== void 0) {
                var o = [];
                o.cw = t;
                o.ch = n;
                o.dpi = a;
                if (r) {
                  o.cb = r;
                }
                return o;
              }
              return [];
            },
          },
        ]);
        return e;
      })();
      var C = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
        }
        (function(e, t, n) {
          if (t) {
            A(e.prototype, t);
          }
          if (n) {
            A(e, n);
          }
        })(e, null, [
          {
            key: 'mathMLToAccessible',
            value: function(t, n, i) {
              if (n === void 0) {
                n = 'en';
              }
              if (o.containClass(t, 'wrs_chemistry')) {
                i.mode = 'chemistry';
              }
              var r = '';
              if (e.cache.get(t)) {
                r = e.cache.get(t);
              } else {
                i.service = 'mathml2accessible';
                i.lang = n;
                var a = JSON.parse(g.getService('service', i));
                if (a.status === 'error') {
                  r = b.get('error_convert_accessibility');
                } else {
                  r = a.result.text;
                  e.cache.populate(t, r);
                }
              }
              return r;
            },
          },
          {
            key: 'cache',
            get: function() {
              return e._cache;
            },
            set: function(t) {
              e._cache = t;
            },
          },
        ]);
        return e;
      })();
      C._cache = new u();
      n(2);
      var T = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
        }
        (function(e, t, n) {
          if (t) {
            M(e.prototype, t);
          }
          if (n) {
            M(e, n);
          }
        })(e, null, [
          {
            key: 'mathmlToImgObject',
            value: function(t, n, i, r) {
              var a = t.createElement('img');
              a.align = 'middle';
              a.style.maxWidth = 'none';
              var s = i || {};
              s.mml = n;
              s.lang = r;
              s.metrics = 'true';
              s.centerbaseline = 'false';
              if (
                l.get('saveMode') === 'base64' &&
                l.get('base64savemode') === 'default'
              ) {
                s.base64 = true;
              }
              a.className = l.get('imageClassName');
              if (n.indexOf('class="') !== -1) {
                var c = n.substring(
                  n.indexOf('class="') + 'class="'.length,
                  n.length
                );
                c = (c = c.substring(0, c.indexOf('"'))).substring(4, c.length);
                a.setAttribute(l.get('imageCustomEditorName'), c);
              }
              if (
                !l.get('wirisPluginPerformance') ||
                (l.get('saveMode') !== 'xml' && l.get('saveMode') !== 'safeXml')
              ) {
                var u = e.createImageSrc(n, s);
                a.setAttribute(
                  l.get('imageMathmlAttribute'),
                  o.safeXmlEncode(n)
                );
                a.src = u;
                k.setImgSize(
                  a,
                  u,
                  l.get('saveMode') === 'base64' &&
                    l.get('base64savemode') === 'default'
                );
                if (l.get('enableAccessibility')) {
                  a.alt = C.mathMLToAccessible(n, r, s);
                }
              } else {
                var d = JSON.parse(e.createShowImageSrc(s, r));
                if (d.status === 'warning') {
                  try {
                    d = JSON.parse(g.getService('showimage', s));
                  } catch (e) {
                    return null;
                  }
                }
                if ((d = d.result).format === 'png') {
                  a.src = 'data:image/png;base64,'.concat(d.content);
                } else {
                  a.src = 'data:image/svg+xml;charset=utf8,'.concat(
                    w.urlEncode(d.content)
                  );
                }
                a.setAttribute(
                  l.get('imageMathmlAttribute'),
                  o.safeXmlEncode(n)
                );
                k.setImgSize(a, d.content, true);
                if (l.get('enableAccessibility')) {
                  if (d.alt === void 0) {
                    a.alt = C.mathMLToAccessible(n, r, s);
                  } else {
                    a.alt = d.alt;
                  }
                }
              }
              if (e.observer !== void 0) {
                e.observer.observe(a);
              }
              a.setAttribute('role', 'math');
              return a;
            },
          },
          {
            key: 'createImageSrc',
            value: function(e, t) {
              if (
                l.get('saveMode') === 'base64' &&
                l.get('base64savemode') === 'default'
              ) {
                t.base64 = true;
              }
              var n = g.getService('createimage', t);
              if (n.indexOf('@BASE@') !== -1) {
                var i = g.getServicePath('createimage').split('/');
                i.pop();
                n = n.split('@BASE@').join(i.join('/'));
              }
              return n;
            },
          },
          {
            key: 'initParse',
            value: function(t, n) {
              t = e.initParseSaveMode(t, n);
              return e.initParseEditMode(t);
            },
          },
          {
            key: 'initParseSaveMode',
            value: function(t, n) {
              if (l.get('saveMode')) {
                t = f.parseMathmlToLatex(t, r.safeXmlCharacters);
                t = f.parseMathmlToLatex(t, r.xmlCharacters);
                t = e.parseMathmlToImg(t, r.safeXmlCharacters, n);
                t = e.parseMathmlToImg(t, r.xmlCharacters, n);
                if (
                  l.get('saveMode') === 'base64' &&
                  l.get('base64savemode') === 'image'
                ) {
                  t = e.codeImgTransform(t, 'base642showimage');
                }
              }
              return t;
            },
          },
          {
            key: 'initParseEditMode',
            value: function(e) {
              if (l.get('parseModes').indexOf('latex') !== -1) {
                var t = w.getElementsByNameFromString(e, 'img', true);
                var n = 'encoding="LaTeX">';
                var i = 0;
                for (var r = 0; r < t.length; r += 1) {
                  var a = e.substring(t[r].start + i, t[r].end + i);
                  if (
                    a.indexOf(
                      ' class="'.concat(l.get('imageClassName'), '"')
                    ) !== -1
                  ) {
                    var s = ' '.concat(l.get('imageMathmlAttribute'), '="');
                    var c = a.indexOf(s);
                    if (c === -1) {
                      s = ' alt="';
                      c = a.indexOf(s);
                    }
                    if (c !== -1) {
                      c += s.length;
                      var u = a.indexOf('"', c);
                      var d = o.safeXmlDecode(a.substring(c, u));
                      var m = d.indexOf(n);
                      if (m !== -1) {
                        m += n.length;
                        var h = d.indexOf('</annotation>', m);
                        var g = d.substring(m, h);
                        var p = '$$'.concat(w.htmlEntitiesDecode(g), '$$');
                        e =
                          e.substring(0, t[r].start + i) +
                          p +
                          e.substring(t[r].end + i);
                        i += p.length - (t[r].end - t[r].start);
                      }
                    }
                  }
                }
              }
              return e;
            },
          },
          {
            key: 'endParse',
            value: function(t) {
              var n = e.endParseEditMode(t);
              return e.endParseSaveMode(n);
            },
          },
          {
            key: 'endParseEditMode',
            value: function(e) {
              if (l.get('parseModes').indexOf('latex') !== -1) {
                var t = '';
                var n = 0;
                for (var i = e.indexOf('$$'); i !== -1; ) {
                  t += e.substring(n, i);
                  if ((n = e.indexOf('$$', i + 2)) === -1) {
                    t += '$$';
                    n = i + 2;
                  } else {
                    var r = e.substring(i + 2, n);
                    var a = w.htmlEntitiesDecode(r);
                    var s = f.getMathMLFromLatex(a, true);
                    if (!l.get('saveHandTraces')) {
                      s = o.removeAnnotation(s, 'application/json');
                    }
                    t += s;
                    n += 2;
                  }
                  i = e.indexOf('$$', n);
                }
                e = t += e.substring(n, e.length);
              }
              return e;
            },
          },
          {
            key: 'endParseSaveMode',
            value: function(t) {
              if (l.get('saveMode')) {
                if (l.get('saveMode') === 'safeXml') {
                  t = e.codeImgTransform(t, 'img2mathml');
                } else if (l.get('saveMode') === 'xml') {
                  t = e.codeImgTransform(t, 'img2mathml');
                } else if (
                  l.get('saveMode') === 'base64' &&
                  l.get('base64savemode') === 'image'
                ) {
                  t = e.codeImgTransform(t, 'img264');
                }
              }
              return t;
            },
          },
          {
            key: 'createShowImageSrc',
            value: function(e, t) {
              var n = {};
              [
                'mml',
                'color',
                'centerbaseline',
                'zoom',
                'dpi',
                'fontSize',
                'fontFamily',
                'defaultStretchy',
                'backgroundColor',
                'format',
              ].forEach(function(t) {
                if (e[t] !== void 0) {
                  n[t] = e[t];
                }
              });
              var i = {};
              Object.keys(e).forEach(function(t) {
                if (t !== 'mml') {
                  i[t] = e[t];
                }
              });
              i.formula = com.wiris.js.JsPluginTools.md5encode(
                w.propertiesToString(n)
              );
              i.lang = t === void 0 ? 'en' : t;
              i.version = l.get('version');
              return g.getService('showimage', w.httpBuildQuery(i), true);
            },
          },
          {
            key: 'codeImgTransform',
            value: function(t, n) {
              var i = '';
              var r = 0;
              var a = /<img/gi;
              for (var s = a.source.length; a.test(t); ) {
                var c = a.lastIndex - s;
                i += t.substring(r, c);
                for (var u = c + 1; u < t.length && r <= c; ) {
                  var d = t.charAt(u);
                  if (d === '"' || d === "'") {
                    var m = t.indexOf(d, u + 1);
                    u = m === -1 ? t.length : m;
                  } else if (d === '>') {
                    r = u + 1;
                  }
                  u += 1;
                }
                if (r < c) {
                  return (i += t.substring(c, t.length));
                }
                var h = t.substring(c, r);
                var g = w.createObject(h);
                var p = g.getAttribute(l.get('imageMathmlAttribute'));
                var f = void 0;
                var v = void 0;
                if (n === 'base642showimage') {
                  if (p == null) {
                    p = g.getAttribute('alt');
                  }
                  p = o.safeXmlDecode(p);
                  h = e.mathmlToImgObject(document, p, null, null);
                  i += w.createObjectCode(h);
                } else if (n === 'img2mathml') {
                  if (l.get('saveMode')) {
                    if (l.get('saveMode') === 'safeXml') {
                      f = true;
                      v = true;
                    } else if (l.get('saveMode') === 'xml') {
                      f = true;
                      v = false;
                    }
                  }
                  i += w.getWIRISImageOutput(h, f, v);
                } else if (n === 'img264') {
                  if (p === null) {
                    p = g.getAttribute('alt');
                  }
                  p = o.safeXmlDecode(p);
                  var _ = { base64: 'true' };
                  h = e.mathmlToImgObject(document, p, _, null);
                  k.setImgSize(h, h.src, true);
                  i += w.createObjectCode(h);
                }
              }
              return (i += t.substring(r, t.length));
            },
          },
          {
            key: 'parseMathmlToImg',
            value: function(t, n, i) {
              var a = '';
              var s = ''.concat(n.tagOpener, 'math');
              var c = ''.concat(n.tagOpener, '/math').concat(n.tagCloser);
              var u = t.indexOf(s);
              for (var d = 0; u !== -1; ) {
                a += t.substring(d, u);
                var m = t.indexOf(l.get('imageMathmlAttribute'));
                if ((d = t.indexOf(c, u)) === -1) {
                  d = t.length - 1;
                } else {
                  d += m !== -1 ? t.indexOf('/>', u) : c.length;
                }
                if (o.isMathmlInAttribute(t, u) || m !== -1) {
                  a += t.substring(u, d);
                } else {
                  var h = t.substring(u, d);
                  h =
                    n.id === r.safeXmlCharacters.id
                      ? o.safeXmlDecode(h)
                      : o.mathMLEntities(h);
                  a += w.createObjectCode(
                    e.mathmlToImgObject(document, h, null, i)
                  );
                }
                u = t.indexOf(s, d);
              }
              return (a += t.substring(d, t.length));
            },
          },
        ]);
        return e;
      })();
      if (typeof MutationObserver != 'undefined') {
        var E = new MutationObserver(function(e) {
          e.forEach(function(e) {
            if (
              e.oldValue === l.get('imageClassName') &&
              e.attributeName === 'class' &&
              e.target.className.indexOf(l.get('imageClassName')) === -1
            ) {
              e.target.className = l.get('imageClassName');
            }
          });
        });
        T.observer = Object.create(E);
        T.observer.Config = { attributes: true, attributeOldValue: true };
        T.observer.observe = function(e) {
          Object.getPrototypeOf(this).observe(e, this.Config);
        };
      }
      var P = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
          this.isContentChanged = false;
          this.waitingForChanges = false;
        }
        (function(e, t, n) {
          if (t) {
            j(e.prototype, t);
          }
          if (n) {
            j(e, n);
          }
        })(e, [
          {
            key: 'setIsContentChanged',
            value: function(e) {
              this.isContentChanged = e;
            },
          },
          {
            key: 'getIsContentChanged',
            value: function() {
              return this.isContentChanged;
            },
          },
          {
            key: 'setWaitingForChanges',
            value: function(e) {
              this.waitingForChanges = e;
            },
          },
          { key: 'caretPositionChanged', value: function(e) {} },
          { key: 'clipboardChanged', value: function(e) {} },
          {
            key: 'contentChanged',
            value: function(e) {
              if (
                this.waitingForChanges === true &&
                this.isContentChanged === false
              ) {
                this.isContentChanged = true;
              }
            },
          },
          { key: 'styleChanged', value: function(e) {} },
          { key: 'transformationReceived', value: function(e) {} },
        ]);
        return e;
      })();
      var I = (function() {
        function e(t) {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
          this.editorAttributes = {};
          if (!('editorAttributes' in t)) {
            throw new Error(
              'ContentManager constructor error: editorAttributes property missed.'
            );
          }
          this.editorAttributes = t.editorAttributes;
          this.customEditors = null;
          if ('customEditors' in t) {
            this.customEditors = t.customEditors;
          }
          this.environment = {};
          if (!('environment' in t)) {
            throw new Error(
              'ContentManager constructor error: environment property missed'
            );
          }
          this.environment = t.environment;
          this.language = '';
          if (!('language' in t)) {
            throw new Error(
              'ContentManager constructor error: language property missed'
            );
          }
          this.language = t.language;
          this.editorListener = new P();
          this.editor = null;
          this.ua = navigator.userAgent.toLowerCase();
          this.deviceProperties = {};
          this.deviceProperties.isAndroid = this.ua.indexOf('android') > -1;
          this.deviceProperties.isIOS = e.isIOS();
          this.toolbar = null;
          this.modalDialogInstance = null;
          this.listeners = new m();
          this.mathML = null;
          this.isNewElement = true;
          this.integrationModel = null;
        }
        (function(e, t, n) {
          if (t) {
            S(e.prototype, t);
          }
          if (n) {
            S(e, n);
          }
        })(
          e,
          [
            {
              key: 'addListener',
              value: function(e) {
                this.listeners.add(e);
              },
            },
            {
              key: 'setIntegrationModel',
              value: function(e) {
                this.integrationModel = e;
              },
            },
            {
              key: 'setModalDialogInstance',
              value: function(e) {
                this.modalDialogInstance = e;
              },
            },
            {
              key: 'insert',
              value: function() {
                this.updateTitle(this.modalDialogInstance);
                this.insertEditor(this.modalDialogInstance);
              },
            },
            {
              key: 'insertEditor',
              value: function() {
                if (e.isEditorLoaded()) {
                  this.editor = window.com.wiris.jsEditor.JsEditor.newInstance(
                    this.editorAttributes
                  );
                  this.editor.insertInto(
                    this.modalDialogInstance.contentContainer
                  );
                  this.editor.focus();
                  if (this.modalDialogInstance.rtl) {
                    this.editor.action('rtl');
                  }
                  if (this.editor.getEditorModel().isRTL()) {
                    this.editor.element.style.direction = 'rtl';
                  }
                  this.editor
                    .getEditorModel()
                    .addEditorListener(this.editorListener);
                  if (this.modalDialogInstance.deviceProperties.isIOS) {
                    setTimeout(function() {
                      if (this.hasOwnProperty('modalDialogInstance')) {
                        this.modalDialogInstance.hideKeyboard();
                      }
                    }, 400);
                    var t = document.getElementsByClassName(
                      'wrs_formulaDisplay'
                    )[0];
                    w.addEvent(
                      t,
                      'focus',
                      this.modalDialogInstance.handleOpenedIosSoftkeyboard
                    );
                    w.addEvent(
                      t,
                      'blur',
                      this.modalDialogInstance.handleClosedIosSoftkeyboard
                    );
                  }
                  this.listeners.fire('onLoad', {});
                } else {
                  setTimeout(e.prototype.insertEditor.bind(this), 100);
                }
              },
            },
            {
              key: 'init',
              value: function() {
                if (!e.isEditorLoaded()) {
                  this.addEditorAsExternalDependency();
                }
              },
            },
            {
              key: 'addEditorAsExternalDependency',
              value: function() {
                var t = document.createElement('script');
                t.type = 'text/javascript';
                var n = l.get('editorUrl');
                var i = document.createElement('a');
                e.setHrefToAnchorElement(i, n);
                e.setProtocolToAnchorElement(i);
                n = e.getURLFromAnchorElement(i);
                var r = this.getEditorStats();
                t.src = ''
                  .concat(n, '?lang=')
                  .concat(this.language, '&stats-editor=')
                  .concat(r.editor, '&stats-mode=')
                  .concat(r.mode, '&stats-version=')
                  .concat(r.version);
                document.getElementsByTagName('head')[0].appendChild(t);
              },
            },
            {
              key: 'getEditorStats',
              value: function() {
                var e = {};
                if ('editor' in this.environment) {
                  e.editor = this.environment.editor;
                } else {
                  e.editor = 'unknown';
                }
                if ('mode' in this.environment) {
                  e.mode = this.environment.mode;
                } else {
                  e.mode = l.get('saveMode');
                }
                if ('version' in this.environment) {
                  e.version = this.environment.version;
                } else {
                  e.version = l.get('version');
                }
                return e;
              },
            },
            {
              key: 'setInitialContent',
              value: function() {
                if (!this.isNewElement) {
                  this.setMathML(this.mathML);
                }
              },
            },
            {
              key: 'setMathML',
              value: function(e, t) {
                var n = this;
                if (t === void 0) {
                  t = false;
                }
                this.editor.setMathMLWithCallback(e, function() {
                  n.editorListener.setWaitingForChanges(true);
                });
                setTimeout(function() {
                  n.editorListener.setIsContentChanged(false);
                }, 500);
                if (!t) {
                  this.onFocus();
                }
              },
            },
            {
              key: 'onFocus',
              value: function() {
                if (this.editor !== void 0 && this.editor != null) {
                  this.editor.focus();
                }
              },
            },
            {
              key: 'submitAction',
              value: function() {
                if (this.editor.isFormulaEmpty()) {
                  this.integrationModel.updateFormula(null);
                } else {
                  var e = this.editor.getMathMLWithSemantics();
                  if (this.customEditors.getActiveEditor() === null) {
                    Object.keys(this.customEditors.editors).forEach(function(
                      t
                    ) {
                      e = o.removeCustomEditorClassAttribute(e, t);
                    });
                  } else {
                    var t = this.customEditors.getActiveEditor().toolbar;
                    e = o.addCustomEditorClassAttribute(e, t);
                  }
                  var n = o.mathMLEntities(e);
                  this.integrationModel.updateFormula(n);
                }
                this.customEditors.disable();
                this.integrationModel.notifyWindowClosed();
                this.setEmptyMathML();
                this.customEditors.disable();
              },
            },
            {
              key: 'setEmptyMathML',
              value: function() {
                if (
                  this.deviceProperties.isAndroid ||
                  this.deviceProperties.isIOS
                ) {
                  if (this.editor.getEditorModel().isRTL()) {
                    this.setMathML(
                      '<math dir="rtl"><semantics><annotation encoding="application/json">[]</annotation></semantics></math>',
                      true
                    );
                  } else {
                    this.setMathML(
                      '<math><semantics><annotation encoding="application/json">[]</annotation></semantics></math>',
                      true
                    );
                  }
                } else if (this.editor.getEditorModel().isRTL()) {
                  this.setMathML('<math dir="rtl"/>', true);
                } else {
                  this.setMathML('<math/>', true);
                }
              },
            },
            {
              key: 'onOpen',
              value: function() {
                if (this.isNewElement) {
                  this.setEmptyMathML();
                } else {
                  this.setMathML(this.mathML);
                }
                this.updateToolbar();
                this.onFocus();
              },
            },
            {
              key: 'updateToolbar',
              value: function() {
                this.updateTitle(this.modalDialogInstance);
                var e = this.customEditors.getActiveEditor();
                if (e) {
                  var t = e.toolbar
                    ? e.toolbar
                    : _wrs_int_wirisProperties.toolbar;
                  if (this.toolbar == null || this.toolbar !== t) {
                    this.setToolbar(t);
                  }
                } else {
                  var n = this.getToolbar();
                  if (this.toolbar == null || this.toolbar !== n) {
                    this.setToolbar(n);
                    this.customEditors.disable();
                  }
                }
              },
            },
            {
              key: 'updateTitle',
              value: function() {
                var e = this.customEditors.getActiveEditor();
                if (e) {
                  this.modalDialogInstance.setTitle(e.title);
                } else {
                  this.modalDialogInstance.setTitle('MathType');
                }
              },
            },
            {
              key: 'getToolbar',
              value: function() {
                var e = 'general';
                if ('toolbar' in this.editorAttributes) {
                  e = this.editorAttributes.toolbar;
                }
                if (e === 'general') {
                  e =
                    typeof _wrs_int_wirisProperties == 'undefined' ||
                    _wrs_int_wirisProperties.toolbar === void 0
                      ? 'general'
                      : _wrs_int_wirisProperties.toolbar;
                }
                return e;
              },
            },
            {
              key: 'setToolbar',
              value: function(e) {
                this.toolbar = e;
                this.editor.setParams({ toolbar: this.toolbar });
              },
            },
            {
              key: 'hasChanges',
              value: function() {
                return (
                  !this.editor.isFormulaEmpty() &&
                  this.editorListener.getIsContentChanged()
                );
              },
            },
            {
              key: 'onKeyDown',
              value: function(e) {
                if (e.key !== void 0 && e.repeat === false) {
                  if (e.key === 'Escape' || e.key === 'Esc') {
                    var t = document.getElementsByClassName(
                      'wrs_expandButton wrs_expandButtonFor3RowsLayout wrs_pressed'
                    );
                    if (
                      t.length === 0 &&
                      (t = document.getElementsByClassName(
                        'wrs_expandButton wrs_expandButtonFor2RowsLayout wrs_pressed'
                      )).length === 0 &&
                      (t = document.getElementsByClassName(
                        'wrs_select wrs_pressed'
                      )).length === 0
                    ) {
                      this.modalDialogInstance.cancelAction();
                      e.stopPropagation();
                      e.preventDefault();
                    }
                  } else if (e.shiftKey && e.key === 'Tab') {
                    if (
                      document.activeElement ===
                      this.modalDialogInstance.submitButton
                    ) {
                      this.editor.focus();
                      e.stopPropagation();
                      e.preventDefault();
                    } else {
                      var n = document.querySelector('[title="Manual"]');
                      if (document.activeElement === n) {
                        this.modalDialogInstance.cancelButton.focus();
                        e.stopPropagation();
                        e.preventDefault();
                      }
                    }
                  } else if (e.key === 'Tab') {
                    if (
                      document.activeElement ===
                      this.modalDialogInstance.cancelButton
                    ) {
                      document.querySelector('[title="Manual"]').focus();
                      e.stopPropagation();
                      e.preventDefault();
                    } else if (
                      document
                        .getElementsByClassName('wrs_formulaDisplay')[0]
                        .getAttribute('class') ===
                      'wrs_formulaDisplay wrs_focused'
                    ) {
                      this.modalDialogInstance.submitButton.focus();
                      e.stopPropagation();
                      e.preventDefault();
                    }
                  }
                }
              },
            },
          ],
          [
            {
              key: 'setHrefToAnchorElement',
              value: function(e, t) {
                e.href = t;
              },
            },
            {
              key: 'setProtocolToAnchorElement',
              value: function(e) {
                if (
                  window.location.href.indexOf('https://') === 0 &&
                  e.protocol === 'http:'
                ) {
                  e.protocol = 'https:';
                }
              },
            },
            {
              key: 'getURLFromAnchorElement',
              value: function(e) {
                var t = e.port === '80' || e.port === '443' || e.port === '';
                return ''
                  .concat(e.protocol, '//')
                  .concat(e.hostname)
                  .concat(t ? '' : ':' + e.port)
                  .concat(
                    e.pathname.startsWith('/') ? e.pathname : '/' + e.pathname
                  );
              },
            },
            {
              key: 'isIOS',
              value: function() {
                return (
                  [
                    'iPad Simulator',
                    'iPhone Simulator',
                    'iPod Simulator',
                    'iPad',
                    'iPhone',
                    'iPod',
                  ].includes(navigator.platform) ||
                  (navigator.userAgent.includes('Mac') &&
                    'ontouchend' in document)
                );
              },
            },
            {
              key: 'isEditorLoaded',
              value: function() {
                return (
                  window.com &&
                  window.com.wiris &&
                  window.com.wiris.jsEditor &&
                  window.com.wiris.jsEditor.JsEditor &&
                  window.com.wiris.jsEditor.JsEditor.newInstance
                );
              },
            },
          ]
        );
        return e;
      })();
      var z = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
          this.editors = [];
          this.activeEditor = 'default';
        }
        (function(e, t, n) {
          if (t) {
            O(e.prototype, t);
          }
          if (n) {
            O(e, n);
          }
        })(e, [
          {
            key: 'addEditor',
            value: function(e, t) {
              var n = {};
              n.name = t.name;
              n.toolbar = t.toolbar;
              n.icon = t.icon;
              n.confVariable = t.confVariable;
              n.title = t.title;
              n.tooltip = t.tooltip;
              this.editors[e] = n;
            },
          },
          {
            key: 'enable',
            value: function(e) {
              this.activeEditor = e;
            },
          },
          {
            key: 'disable',
            value: function() {
              this.activeEditor = 'default';
            },
          },
          {
            key: 'getActiveEditor',
            value: function() {
              if (this.activeEditor === 'default') {
                return null;
              } else {
                return this.editors[this.activeEditor];
              }
            },
          },
        ]);
        return e;
      })();
      var L = {
        imageCustomEditorName: 'data-custom-editor',
        imageClassName: 'Wirisformula',
        CASClassName: 'Wiriscas',
      };
      var N = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
          this.cancelled = false;
          this.defaultPrevented = false;
        }
        (function(e, t, n) {
          if (t) {
            B(e.prototype, t);
          }
          if (n) {
            B(e, n);
          }
        })(e, [
          {
            key: 'cancel',
            value: function() {
              this.cancelled = true;
            },
          },
          {
            key: 'preventDefault',
            value: function() {
              this.defaultPrevented = true;
            },
          },
        ]);
        return e;
      })();
      var F;
      var R = (function() {
        function e(t) {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
          this.overlayElement = t.overlayElement;
          this.callbacks = t.callbacks;
          this.overlayWrapper = this.overlayElement.appendChild(
            document.createElement('div')
          );
          this.overlayWrapper.setAttribute(
            'class',
            'wrs_popupmessage_overlay_envolture'
          );
          this.message = this.overlayWrapper.appendChild(
            document.createElement('div')
          );
          this.message.id = 'wrs_popupmessage';
          this.message.setAttribute('class', 'wrs_popupmessage_panel');
          this.message.setAttribute('role', 'dialog');
          this.message.setAttribute('aria-describedby', 'description_txt');
          var n = document.createElement('p');
          var i = document.createTextNode(t.strings.message);
          n.appendChild(i);
          n.id = 'description_txt';
          this.message.appendChild(n);
          var r = this.overlayWrapper.appendChild(
            document.createElement('div')
          );
          r.setAttribute('class', 'wrs_popupmessage_overlay');
          r.addEventListener('click', this.cancelAction.bind(this));
          this.buttonArea = this.message.appendChild(
            document.createElement('div')
          );
          this.buttonArea.setAttribute('class', 'wrs_popupmessage_button_area');
          this.buttonArea.id = 'wrs_popup_button_area';
          var a = {
            class: 'wrs_button_accept',
            innerHTML: t.strings.submitString,
            id: 'wrs_popup_accept_button',
          };
          this.closeButton = this.createButton(a, this.closeAction.bind(this));
          this.buttonArea.appendChild(this.closeButton);
          var o = {
            class: 'wrs_button_cancel',
            innerHTML: t.strings.cancelString,
            id: 'wrs_popup_cancel_button',
          };
          this.cancelButton = this.createButton(
            o,
            this.cancelAction.bind(this)
          );
          this.buttonArea.appendChild(this.cancelButton);
        }
        (function(e, t, n) {
          if (t) {
            D(e.prototype, t);
          }
          if (n) {
            D(e, n);
          }
        })(e, [
          {
            key: 'createButton',
            value: function(e, t) {
              var n = {};
              (n = document.createElement('button')).setAttribute('id', e.id);
              n.setAttribute('class', e.class);
              n.innerHTML = e.innerHTML;
              n.addEventListener('click', t);
              return n;
            },
          },
          {
            key: 'show',
            value: function() {
              if (this.overlayWrapper.style.display === 'block') {
                this.overlayWrapper.style.display = 'none';
              } else {
                document.activeElement.blur();
                this.overlayWrapper.style.display = 'block';
                this.closeButton.focus();
              }
            },
          },
          {
            key: 'cancelAction',
            value: function() {
              this.overlayWrapper.style.display = 'none';
              if (this.callbacks.cancelCallback !== void 0) {
                this.callbacks.cancelCallback();
              }
            },
          },
          {
            key: 'closeAction',
            value: function() {
              this.cancelAction();
              if (this.callbacks.closeCallback !== void 0) {
                this.callbacks.closeCallback();
              }
            },
          },
          {
            key: 'onKeyDown',
            value: function(e) {
              if (e.key !== void 0) {
                if (e.key === 'Escape' || e.key === 'Esc') {
                  this.cancelAction();
                  e.stopPropagation();
                  e.preventDefault();
                } else if (e.key === 'Tab') {
                  if (document.activeElement === this.closeButton) {
                    this.cancelButton.focus();
                  } else {
                    this.closeButton.focus();
                  }
                  e.stopPropagation();
                  e.preventDefault();
                }
              }
            },
          },
        ]);
        return e;
      })();
      var U = new Uint8Array(16);
      var X = /^(?:[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}|00000000-0000-0000-0000-000000000000)$/i;
      var H = function(e) {
        return typeof e == 'string' && X.test(e);
      };
      var W = [];
      for (var V = 0; V < 256; ++V) {
        W.push((V + 256).toString(16).substr(1));
      }
      var J = function(e) {
        var t =
          arguments.length > 1 && arguments[1] !== void 0 ? arguments[1] : 0;
        var n = (
          W[e[t + 0]] +
          W[e[t + 1]] +
          W[e[t + 2]] +
          W[e[t + 3]] +
          '-' +
          W[e[t + 4]] +
          W[e[t + 5]] +
          '-' +
          W[e[t + 6]] +
          W[e[t + 7]] +
          '-' +
          W[e[t + 8]] +
          W[e[t + 9]] +
          '-' +
          W[e[t + 10]] +
          W[e[t + 11]] +
          W[e[t + 12]] +
          W[e[t + 13]] +
          W[e[t + 14]] +
          W[e[t + 15]]
        ).toLowerCase();
        if (!H(n)) {
          throw TypeError('Stringified UUID is invalid');
        }
        return n;
      };
      var K = function(e, t, n) {
        var i =
          (e = e || {}).random ||
          (e.rng ||
            function() {
              if (
                !F &&
                !(F =
                  (typeof crypto != 'undefined' &&
                    crypto.getRandomValues &&
                    crypto.getRandomValues.bind(crypto)) ||
                  (typeof msCrypto != 'undefined' &&
                    typeof msCrypto.getRandomValues == 'function' &&
                    msCrypto.getRandomValues.bind(msCrypto)))
              ) {
                throw new Error(
                  'crypto.getRandomValues() not supported. See https://github.com/uuidjs/uuid#getrandomvalues-not-supported'
                );
              }
              return F(U);
            })();
        i[6] = (15 & i[6]) | 64;
        i[8] = (63 & i[8]) | 128;
        if (t) {
          n = n || 0;
          for (var r = 0; r < 16; ++r) {
            t[n + r] = i[r];
          }
          return t;
        }
        return J(i);
      };
      var q = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
          throw new Error(
            'Static class StringManager can not be instantiated.'
          );
        }
        (function(e, t, n) {
          if (t) {
            Q(e.prototype, t);
          }
          if (n) {
            Q(e, n);
          }
        })(e, null, [
          {
            key: 'send',
            value: function(t) {
              var n = {
                method: 'POST',
                cache: 'no-cache',
                headers: {
                  'Content-Type': 'application/json',
                  'X-Api-Key': 'CK20op1pOx2LAUjPFP7kB2UPveHZRidG51UJE26m',
                  'Accept-Version': '1',
                },
                body: JSON.stringify(e.composeBody(t)),
              };
              return fetch(e.endpoint, n)
                .then(function(e) {
                  return e;
                })
                .catch(function(e) {});
            },
          },
          {
            key: 'composeBody',
            value: function(t) {
              return { messages: t, sender: e.sender, session: e.session };
            },
          },
          {
            key: 'composeUUID',
            value: function() {
              return K();
            },
          },
          {
            key: 'composeSenderUUID',
            value: function() {
              return this.composeUUID();
            },
          },
          {
            key: 'composeCookie',
            value: function(e, t, n) {
              var i = n == null ? '' : '; max-age='.concat(n);
              return ''
                .concat(e, '=')
                .concat(t)
                .concat(i);
            },
          },
          {
            key: 'senderId',
            get: function() {
              if (!this._senderId) {
                var t = document.cookie.split(';').map(function(e) {
                  return e.trim().split('=');
                });
                var n = true;
                var i = false;
                var r = void 0;
                try {
                  var a;
                  for (
                    var o = t[Symbol.iterator]();
                    !(n = (a = o.next()).done);
                    n = true
                  ) {
                    var s = Y(a.value, 2);
                    var l = s[0];
                    var c = s[1];
                    if (l === Z) {
                      this._senderId = c;
                      break;
                    }
                  }
                } catch (e) {
                  i = true;
                  r = e;
                } finally {
                  try {
                    if (!n && o.return != null) {
                      o.return();
                    }
                  } finally {
                    if (i) {
                      throw r;
                    }
                  }
                }
                if (!this._senderId) {
                  this._senderId = e.composeUUID();
                  document.cookie = this.composeCookie(Z, this._senderId, G);
                }
              }
              return this._senderId;
            },
          },
          {
            key: 'sessionId',
            get: function() {
              if (!this._sessionId) {
                this._sessionId = e.composeUUID();
              }
              return this._sessionId;
            },
          },
          {
            key: 'session',
            get: function() {
              return { id: e.sessionId, page: 0 };
            },
          },
          {
            key: 'sender',
            get: function() {
              return {
                id: e.senderId,
                os: navigator.oscpu,
                user_agent: window.navigator.userAgent,
                domain: window.location.hostname,
                deployment: e.deployment,
                editor_version: WirisPlugin.currentInstance.environment
                  .editorVersion
                  ? WirisPlugin.currentInstance.environment.editorVersion
                  : '',
                language: WirisPlugin.currentInstance.language,
                product_version: WirisPlugin.currentInstance.version,
                backend: WirisPlugin.currentInstance.serviceProviderProperties
                  .server
                  ? WirisPlugin.currentInstance.serviceProviderProperties.server
                  : '',
              };
            },
          },
          {
            key: 'deployment',
            get: function() {
              var e = WirisPlugin.currentInstance.environment.editor;
              var t = '';
              if (/Generic/.test(e)) {
                t = 'generic';
              } else if (/Froala/.test(e)) {
                t = 'froala';
              } else if (/CKEditor/.test(e)) {
                t = 'ckeditor';
              } else if (/TinyMCE/.test(e)) {
                t = 'tinymce';
              }
              return ''.concat('mathtype-web-plugin-').concat(t);
            },
          },
        ]);
        return e;
      })();
      var Z = 'wiris_telemetry_mathtype_web_senderid';
      var G = 31536e4;
      q.endpoint = 'https://telemetry.wiris.net';
      q._senderId = '';
      q._sessionId = '';
      var ee = (function() {
        function e(t) {
          var n = this;
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
          this.language = 'en';
          this.serviceProviderProperties = {};
          if ('serviceProviderProperties' in t) {
            this.serviceProviderProperties = t.serviceProviderProperties;
          }
          this.configurationService = '';
          if ('configurationService' in t) {
            this.serviceProviderProperties.URI = t.configurationService;
            console.warn(
              'Deprecated property configurationService. Use serviceParameters on instead.',
              [t.configurationService]
            );
          }
          this.version = 'version' in t ? t.version : '';
          this.target = null;
          if (!('target' in t)) {
            throw new Error(
              'IntegrationModel constructor error: target property missed.'
            );
          }
          this.target = t.target;
          if ('scriptName' in t) {
            this.scriptName = t.scriptName;
          }
          this.callbackMethodArguments = {};
          if ('callbackMethodArguments' in t) {
            this.callbackMethodArguments = t.callbackMethodArguments;
          }
          this.environment = {};
          if ('environment' in t) {
            this.environment = t.environment;
          }
          this.isIframe = false;
          if (this.target != null) {
            this.isIframe = this.target.tagName.toUpperCase() === 'IFRAME';
          }
          this.editorObject = null;
          if ('editorObject' in t) {
            this.editorObject = t.editorObject;
          }
          this.rtl = false;
          if ('rtl' in t) {
            this.rtl = t.rtl;
          }
          this.managesLanguage = false;
          if ('managesLanguage' in t) {
            this.managesLanguage = t.managesLanguage;
          }
          this.temporalImageResizing = false;
          this.core = null;
          this.listeners = new m();
          if ('integrationParameters' in t) {
            e.integrationParameters.forEach(function(e) {
              if (e in t.integrationParameters) {
                var i = t.integrationParameters[e];
                if (Object.keys(i).length !== 0) {
                  n[e] = i;
                }
              }
            });
          }
        }
        (function(e, t, n) {
          if (t) {
            $(e.prototype, t);
          }
          if (n) {
            $(e, n);
          }
        })(
          e,
          [
            {
              key: 'init',
              value: function() {
                var e = this;
                this.language = this.getLanguage();
                var t = m.newListener('onLoad', function() {
                  e.callbackFunction(e.callbackMethodArguments);
                });
                if (
                  this.serviceProviderProperties.URI.indexOf(
                    'configuration'
                  ) !== -1
                ) {
                  var n = this.serviceProviderProperties.URI;
                  var i = g.getServerLanguageFromService(n);
                  this.serviceProviderProperties.server = i;
                  var r = this.serviceProviderProperties.URI.indexOf(
                    'configuration'
                  );
                  var a = this.serviceProviderProperties.URI.substring(0, r);
                  this.serviceProviderProperties.URI = a;
                }
                var o = this.serviceProviderProperties.URI;
                o =
                  o.indexOf('/') === 0 || o.indexOf('http') === 0
                    ? o
                    : w.concatenateUrl(this.getPath(), o);
                this.serviceProviderProperties.URI = o;
                var s = {};
                s.serviceProviderProperties = this.serviceProviderProperties;
                this.setCore(new ge(s));
                this.core.addListener(t);
                this.core.language = this.language;
                this.core.init();
                this.core.setEnvironment(this.environment);
              },
            },
            {
              key: 'getPath',
              value: function() {
                if (this.scriptName === void 0) {
                  throw new Error('scriptName property needed for getPath.');
                }
                var e = document.getElementsByTagName('script');
                var t = '';
                for (var n = 0; n < e.length; n += 1) {
                  var i = e[n].src.lastIndexOf(this.scriptName);
                  if (i >= 0) {
                    t = e[n].src.substr(0, i - 1);
                  }
                }
                return t;
              },
            },
            {
              key: 'getVersion',
              value: function() {
                return this.version;
              },
            },
            {
              key: 'setLanguage',
              value: function(e) {
                this.language = e;
              },
            },
            {
              key: 'setCore',
              value: function(e) {
                this.core = e;
                e.setIntegrationModel(this);
              },
            },
            {
              key: 'getCore',
              value: function() {
                return this.core;
              },
            },
            {
              key: 'setTarget',
              value: function(e) {
                this.target = e;
                this.isIframe = this.target.tagName.toUpperCase() === 'IFRAME';
              },
            },
            {
              key: 'setEditorObject',
              value: function(e) {
                this.editorObject = e;
              },
            },
            {
              key: 'openNewFormulaEditor',
              value: function() {
                this.core.editionProperties.isNewElement = true;
                this.core.openModalDialog(this.target, this.isIframe);
              },
            },
            {
              key: 'openExistingFormulaEditor',
              value: function() {
                this.core.editionProperties.isNewElement = false;
                this.core.openModalDialog(this.target, this.isIframe);
              },
            },
            {
              key: 'updateFormula',
              value: function(e) {
                var t;
                var n;
                if (this.editorParameters) {
                  e = com.wiris.editor.util.EditorUtils.addAnnotation(
                    e,
                    'application/vnd.wiris.mtweb-params+json',
                    JSON.stringify(this.editorParameters)
                  );
                }
                if (this.isIframe) {
                  t = this.target.contentWindow;
                  n = this.target.contentWindow;
                } else {
                  t = this.target;
                  n = window;
                }
                var i = this.core.beforeUpdateFormula(e, null);
                if (
                  i &&
                  (i = this.insertFormula(t, n, i.mathml, i.wirisProperties))
                ) {
                  return this.core.afterUpdateFormula(
                    i.focusElement,
                    i.windowTarget,
                    i.node,
                    i.latex
                  );
                } else {
                  return '';
                }
              },
            },
            {
              key: 'insertFormula',
              value: function(e, t, n, i) {
                return this.core.insertFormula(e, t, n, i);
              },
            },
            {
              key: 'getSelection',
              value: function() {
                if (this.isIframe) {
                  this.target.contentWindow.focus();
                  return this.target.contentWindow.getSelection();
                } else {
                  this.target.focus();
                  return window.getSelection();
                }
              },
            },
            {
              key: 'addEvents',
              value: function() {
                var e = this;
                var t = this.isIframe
                  ? this.target.contentWindow.document
                  : this.target;
                w.addElementEvents(
                  t,
                  function(t, n) {
                    e.doubleClickHandler(t, n);
                  },
                  function(t, n) {
                    e.mousedownHandler(t, n);
                  },
                  function(t, n) {
                    e.mouseupHandler(t, n);
                  }
                );
              },
            },
            {
              key: 'doubleClickHandler',
              value: function(e) {
                if (e.nodeName.toLowerCase() === 'img') {
                  this.core.getCustomEditors().disable();
                  var t = l.get('imageCustomEditorName');
                  if (e.hasAttribute(t)) {
                    var n = e.getAttribute(t);
                    this.core.getCustomEditors().enable(n);
                  }
                  if (w.containsClass(e, l.get('imageClassName'))) {
                    this.core.editionProperties.temporalImage = e;
                    this.core.editionProperties.isNewElement = true;
                    this.openExistingFormulaEditor();
                  }
                }
              },
            },
            {
              key: 'mouseupHandler',
              value: function() {
                var e = this;
                if (this.temporalImageResizing) {
                  setTimeout(function() {
                    k.fixAfterResize(e.temporalImageResizing);
                  }, 10);
                }
              },
            },
            {
              key: 'mousedownHandler',
              value: function(e) {
                if (
                  e.nodeName.toLowerCase() === 'img' &&
                  w.containsClass(e, l.get('imageClassName'))
                ) {
                  this.temporalImageResizing = e;
                }
              },
            },
            {
              key: 'getLanguage',
              value: function() {
                return this.getBrowserLanguage();
              },
            },
            {
              key: 'getBrowserLanguage',
              value: function() {
                if (navigator.userLanguage) {
                  return navigator.userLanguage.substring(0, 2);
                } else if (navigator.language) {
                  return navigator.language.substring(0, 2);
                } else {
                  return 'en';
                }
              },
            },
            {
              key: 'callbackFunction',
              value: function() {
                var e = this;
                var t = m.newListener('onTargetReady', function() {
                  e.addEvents(e.target);
                });
                this.listeners.add(t);
              },
            },
            { key: 'notifyWindowClosed', value: function() {} },
            { key: 'getMathmlFromTextNode', value: function(e, t) {} },
            { key: 'fillNonLatexNode', value: function(e, t, n) {} },
            { key: 'getSelectedItem', value: function(e, t) {} },
          ],
          [
            {
              key: 'setTemporalImageToNull',
              value: function() {
                if (WirisPlugin.currentInstance) {
                  WirisPlugin.currentInstance.core.editionProperties.temporalImage = null;
                }
              },
            },
          ]
        );
        return e;
      })();
      ee.prototype.getMathmlFromTextNode = void 0;
      ee.prototype.fillNonLatexNode = void 0;
      ee.prototype.getSelectedItem = void 0;
      ee.integrationParameters = [
        'serviceProviderProperties',
        'editorParameters',
      ];
      var te =
        '<?xml version="1.0" encoding="UTF-8" standalone="no"?>\n<svg\n   xmlns:dc="http://purl.org/dc/elements/1.1/"\n   xmlns:cc="http://creativecommons.org/ns#"\n   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"\n   xmlns:svg="http://www.w3.org/2000/svg"\n   xmlns="http://www.w3.org/2000/svg"\n   xmlns:xlink="http://www.w3.org/1999/xlink"\n   viewBox="0 0 13.76 13.76"\n   height="13.76"\n   width="13.76"\n   id="svg3783"\n   version="1.1">\n  <metadata\n     id="metadata3789">\n    <rdf:RDF>\n      <cc:Work\n         rdf:about="">\n        <dc:format>image/svg+xml</dc:format>\n        <dc:type\n           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />\n        <dc:title></dc:title>\n      </cc:Work>\n    </rdf:RDF>\n  </metadata>\n  <defs\n     id="defs3787" />\n  <image\n     y="0"\n     x="0"\n     id="image3791"\n     xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAArCAYAAADhXXHAAAAACXBIWXMAAC4jAAAuIwF4pT92AAAB\nvklEQVRYw83Z23GDMBAF0AsNhBIowSVQgjuISnAJKSEdZNOBS6CDOBUkqSC4gs2PyGhAQg92se4M\n4w8bccYW2hVumBmRdAB6ADfopQcw2SOYNoIkAL8APgB8AzgLI0/2S/iy1xkt3B9m9h0dM9/YHxM4\nJ/c4MfPkGX+y763OyYVKgUPQTXAJdC84Bg2CS6Gl4FSoF7wHmgvOhbrgzsW+8L4YJegccrEj749R\ngs7ZXGdz8wbAeNbREcDTzrHvblEgBbAUFACuy6JALJeL0E/P9sbvmBnNojcgAM+oJ58AhrlnWM5Z\nA+C9RmiokakBvIJuNTLSc7hojqY0Mo8EB6Ep2CPBm9BU7BHgKDQHqwlOguZiNcDJ0JLe4FV4iaLY\nJjF16dLqnoob+EdDs8A1QJPBtUCTwDVBo+DaoJvgNvBIR6rDl9wirbA1QIPgVgl6VwHb+dAr7Jkk\nS/Pg3mCkVOslxxV9yBFqSqTA/3N2Utkzye3pftw5OxzQ5tHeddcdzGj3o4VgClUwowgtAVOs3BpF\naA6YUnsDowhNAVNu12UUoVtgCn2+ifxp1wO42Ner4KPR5dJ2tsse2ZLvTQxbVf4AmC2z7WnSvpIA\nAAAASUVORK5CYII=\n"\n     style="image-rendering:optimizeQuality"\n     preserveAspectRatio="none"\n     height="13.76"\n     width="13.76" />\n</svg>\n';
      var ne =
        '<?xml version="1.0" encoding="UTF-8" standalone="no"?>\n<svg\n   xmlns:dc="http://purl.org/dc/elements/1.1/"\n   xmlns:cc="http://creativecommons.org/ns#"\n   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"\n   xmlns:svg="http://www.w3.org/2000/svg"\n   xmlns="http://www.w3.org/2000/svg"\n   xmlns:xlink="http://www.w3.org/1999/xlink"\n   viewBox="0 0 13.76 13.76"\n   height="13.76"\n   width="13.76"\n   id="svg2"\n   version="1.1">\n  <metadata\n     id="metadata8">\n    <rdf:RDF>\n      <cc:Work\n         rdf:about="">\n        <dc:format>image/svg+xml</dc:format>\n        <dc:type\n           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />\n        <dc:title></dc:title>\n      </cc:Work>\n    </rdf:RDF>\n  </metadata>\n  <defs\n     id="defs6" />\n  <image\n     y="0"\n     x="0"\n     id="image10"\n     xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAArCAYAAADhXXHAAAAACXBIWXMAAC4jAAAuIwF4pT92AAAB\n2ElEQVRYw9XZoXPCMBTH8S+5KfDzQ29606CH3/SmQTO96aGHHn/F0Himh8eDZSblQknSJH2F0DtE\nQw8+12vyfulr7XY7LuW4qvj+DugD18AC+AE2woa+/mz07y9cF7Y8d7YPDEtjK2AsCB4BvdLYHPi0\nXawioAA3wAfQaQiKHhuFYl1QSbAL6gWrSKgEuArqBKsEaB1wKNQKVsasHybcpRhwLNQED0zsoMbz\nFwJOhWL6Cmzd2e0D14Wi1/k9di2wFNnAEtBifd9jv4GtIPgaeBOCAkzLFayr/6idWSSY6DJ8sHT9\n6VK6zRFqKwo5gQ+grnKbA/gI6gsy5wRboT7sucBOaBX21GAvNAR7KnAlNBTbNDgIGoMtwO/C0Gko\nNBZbN525tk+dJrAj4F4YGxXgVQS019DkCgarM0OjwCoDaDBYZQINAquMoJVglRnUC1YZQp1g1RB0\nJryn65jYJ0HoRGPHguDX8hsZ6VAiGX4eUrJBbHqSArdN7LLBmCcBnpvYWfHWo6E8Wge8Ar7Kj8E4\nARwcnBPBB20BE7uJBMdAU8BH/YvyBAsFp0BjwNZGi201qALXgYaAnR0hX2upAzwDj/p8raFL5I4u\n8ALc6vNfvc+ztq5al9Rh/AfwZZ/LmlMllAAAAABJRU5ErkJggg==\n"\n     style="image-rendering:optimizeQuality"\n     preserveAspectRatio="none"\n     height="13.76"\n     width="13.76" />\n</svg>\n';
      var ie =
        '<?xml version="1.0" encoding="UTF-8" standalone="no"?>\n<svg\n   xmlns:dc="http://purl.org/dc/elements/1.1/"\n   xmlns:cc="http://creativecommons.org/ns#"\n   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"\n   xmlns:svg="http://www.w3.org/2000/svg"\n   xmlns="http://www.w3.org/2000/svg"\n   xmlns:xlink="http://www.w3.org/1999/xlink"\n   viewBox="0 0 13.76 13.76"\n   height="13.76"\n   width="13.76"\n   id="svg3793"\n   version="1.1">\n  <metadata\n     id="metadata3799">\n    <rdf:RDF>\n      <cc:Work\n         rdf:about="">\n        <dc:format>image/svg+xml</dc:format>\n        <dc:type\n           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />\n        <dc:title></dc:title>\n      </cc:Work>\n    </rdf:RDF>\n  </metadata>\n  <defs\n     id="defs3797" />\n  <image\n     y="0"\n     x="0"\n     id="image3801"\n     xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAArCAYAAADhXXHAAAAAAXNSR0IArs4c6QAAAARnQU1BAACx\njwv8YQUAAAAJcEhZcwAALiMAAC4jAXilP3YAAAG4SURBVFhHvZnhUYNAEEbRBkwH2oGUkA40FWgJ\nKSEdaAmxA0vQDmIHKSFWgPuAHZkEAnd8y5v5kuNHMm+WY1mSm6qqCiGlZdUspXzxopY9Wu6bpZQf\nSxlRWapwVx9p2dy2CxUHy9ryWx9pKdWyECYcIQshwlGyIBeOlAWpcLQsyISXkAWEX5tlPkvJwnP7\nns1SsnvLS7PMZwlZiShEy8pEIVJWKgpRsnJRiJBNFf2wbCzjfZgRUZi9JYWDxT9bWk6WIXbKym4t\nKRVloObO5oze6ZClWX9a5jyOcOrfmuUkXPRUH/1zVRhZpvsnCxN+jnDqHh0SdQaFu9vg0ZIqrBZ1\neoXP92yKcJSocyHcd4FNEY4WdbrCR1rGrukMF9BWVhZvLZ7U9rS2nH9HVvoq63iFu+RUlOpIuCYL\nCCPIqVjq1A9j5R3aBnMY2kKzMlbZHPQVbVHLhomCUjZUFFSy35ZQUVDIMo+Gi4JCltFwERSy75Y5\n4+VkFLLcKHLHyyRUF1jOeJmMShbChZWy0Df8yFDLgg8/cpCN6I9cdHJhZHmy7X2anAnCtDUZ/j/Y\ng2X2j709MHhTDAFF8QdK9SRpUl2yFgAAAABJRU5ErkJggg==\n"\n     style="image-rendering:optimizeQuality"\n     preserveAspectRatio="none"\n     height="13.76"\n     width="13.76" />\n</svg>\n';
      var re =
        '<?xml version="1.0" encoding="UTF-8" standalone="no"?>\n<svg\n   xmlns:dc="http://purl.org/dc/elements/1.1/"\n   xmlns:cc="http://creativecommons.org/ns#"\n   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"\n   xmlns:svg="http://www.w3.org/2000/svg"\n   xmlns="http://www.w3.org/2000/svg"\n   xmlns:xlink="http://www.w3.org/1999/xlink"\n   viewBox="0 0 13.76 13.76"\n   height="13.76"\n   width="13.76"\n   id="svg12"\n   version="1.1">\n  <metadata\n     id="metadata18">\n    <rdf:RDF>\n      <cc:Work\n         rdf:about="">\n        <dc:format>image/svg+xml</dc:format>\n        <dc:type\n           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />\n        <dc:title></dc:title>\n      </cc:Work>\n    </rdf:RDF>\n  </metadata>\n  <defs\n     id="defs16" />\n  <image\n     y="0"\n     x="0"\n     id="image20"\n     xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAArCAYAAADhXXHAAAAAAXNSR0IArs4c6QAAAARnQU1BAACx\njwv8YQUAAAAJcEhZcwAALiMAAC4jAXilP3YAAAGMSURBVFhHvdk7TsNAFIVhQ0l6elLDJqCGngXQ\nU7MA6rALahZATQ81C6APrXP/jEaKHD/i8TnzS1eaICF/2I4f4qxt20bYOmaVlrK2Mb8s1Nj3mIu0\nlPYZszlPa1kvMf9pKe02Zq3Gcrhc4JUaSzawA0sWsAtLcrATS1KwG0sycA0sAd6kZXm1sNzVHtOy\nvBpYoK8xV/tPC3JjZVByYqVQcmHlUHJgLVBSY0ugPP7xO5PXYSW2FMr19ytm8sahxD7ElEBzk3c6\nsFysn/afymKPvsXMueh3oblRMNibmPuYZ34wsyWHfqhB8OFpwKvDHLADmusFd8/ZU8FOaO4I3PcF\nmwLXgOYOwVtexdnwdUy3vg2UQPnD2eji+vZsrruHS/eoBEpjWMpgrhi1Dv1gY6fBkuRQmtqzJVmg\npMbaoKTEWqGkwtqhpMBWgZICWwVKCuwpzxKSFNi5T2vFqb5gVcAqLNnBSixZwWos2cBg/9JSmgUM\n9iMt5QFe8tZ8VP6n3WXMHQtxPzHfabm0ptkBwWhpthzMp7YAAAAASUVORK5CYII=\n"\n     style="image-rendering:optimizeQuality"\n     preserveAspectRatio="none"\n     height="13.76"\n     width="13.76" />\n</svg>\n';
      var ae =
        '<?xml version="1.0" encoding="UTF-8" standalone="no"?>\n<svg\n   xmlns:dc="http://purl.org/dc/elements/1.1/"\n   xmlns:cc="http://creativecommons.org/ns#"\n   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"\n   xmlns:svg="http://www.w3.org/2000/svg"\n   xmlns="http://www.w3.org/2000/svg"\n   xmlns:xlink="http://www.w3.org/1999/xlink"\n   viewBox="0 0 13.76 13.76"\n   height="13.76"\n   width="13.76"\n   id="svg3813"\n   version="1.1">\n  <metadata\n     id="metadata3819">\n    <rdf:RDF>\n      <cc:Work\n         rdf:about="">\n        <dc:format>image/svg+xml</dc:format>\n        <dc:type\n           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />\n        <dc:title></dc:title>\n      </cc:Work>\n    </rdf:RDF>\n  </metadata>\n  <defs\n     id="defs3817" />\n  <image\n     y="0"\n     x="0"\n     id="image3821"\n     xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAArCAYAAADhXXHAAAAACXBIWXMAAC4jAAAuIwF4pT92AAAA\nnUlEQVRYw+3Z0QnCMBSF4T/FATqCG1g3cISO0NE6iiPoCE5gneD40ohPvgkJ/AcC9/EjHELgliT0\nkoGOIlasWLFixYoVK1asWLFixYoVK1bsjxy+5hlYgLEx47ofSEKSJW1nTUJJMgLPDlpwHoCpk8rO\nvgZixf4Zu3Vi3cq+WroBp4ahL+BYa3AB7o1CH7vvc7M1U4N/g2sdSk8bxjfDaMNdr+hmAQAAAABJ\nRU5ErkJggg==\n"\n     style="image-rendering:optimizeQuality"\n     preserveAspectRatio="none"\n     height="13.76"\n     width="13.76" />\n</svg>\n';
      var oe =
        '<?xml version="1.0" encoding="UTF-8" standalone="no"?>\n<svg\n   xmlns:dc="http://purl.org/dc/elements/1.1/"\n   xmlns:cc="http://creativecommons.org/ns#"\n   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"\n   xmlns:svg="http://www.w3.org/2000/svg"\n   xmlns="http://www.w3.org/2000/svg"\n   xmlns:xlink="http://www.w3.org/1999/xlink"\n   viewBox="0 0 13.76 13.76"\n   height="13.76"\n   width="13.76"\n   id="svg32"\n   version="1.1">\n  <metadata\n     id="metadata38">\n    <rdf:RDF>\n      <cc:Work\n         rdf:about="">\n        <dc:format>image/svg+xml</dc:format>\n        <dc:type\n           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />\n        <dc:title></dc:title>\n      </cc:Work>\n    </rdf:RDF>\n  </metadata>\n  <defs\n     id="defs36" />\n  <image\n     y="0"\n     x="0"\n     id="image40"\n     xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAArCAYAAADhXXHAAAAACXBIWXMAAC4jAAAuIwF4pT92AAAA\npklEQVRYw+3ZLQ4CMRCG4bcbFOvXg99T7FG4BafAw1VALx7dWyy2mIoGgSOZJu/n6p70ZybppFIK\nvWSgo4gVK1asWLFixYoVK1asWLFixYoV+yO7r/UMHIAxiO8FZGBrsUfgDEwBN/QNXIA11S/PW1Bo\nCz4N9ein4Nd1Dyw9PbDR0iVW7J+xudax6HkOtZVdg0MfQE7N0G4GlmANYgNW4A6QepowfgDMXB26\nb1V6LAAAAABJRU5ErkJggg==\n"\n     style="image-rendering:optimizeQuality"\n     preserveAspectRatio="none"\n     height="13.76"\n     width="13.76" />\n</svg>\n';
      var se =
        '<?xml version="1.0" encoding="UTF-8" standalone="no"?>\n<svg\n   xmlns:dc="http://purl.org/dc/elements/1.1/"\n   xmlns:cc="http://creativecommons.org/ns#"\n   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"\n   xmlns:svg="http://www.w3.org/2000/svg"\n   xmlns="http://www.w3.org/2000/svg"\n   xmlns:xlink="http://www.w3.org/1999/xlink"\n   viewBox="0 0 13.76 13.76"\n   height="13.76"\n   width="13.76"\n   id="svg3823"\n   version="1.1">\n  <metadata\n     id="metadata3829">\n    <rdf:RDF>\n      <cc:Work\n         rdf:about="">\n        <dc:format>image/svg+xml</dc:format>\n        <dc:type\n           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />\n        <dc:title></dc:title>\n      </cc:Work>\n    </rdf:RDF>\n  </metadata>\n  <defs\n     id="defs3827" />\n  <image\n     y="0"\n     x="0"\n     id="image3831"\n     xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAArCAYAAADhXXHAAAAAAXNSR0IArs4c6QAAAARnQU1BAACx\njwv8YQUAAAAJcEhZcwAALiMAAC4jAXilP3YAAAHOSURBVFhH1ZiLUcMwEEQNDcQl0AEuISVABZhO\nUkroICVAB6ECoINQgdmVfR5FlmQrkZzjzezEzsc8NPqcdNd1XfVfuB9ec3NAmv4yiRo5ImzBlm+c\nwZYtEHJCGsT3eSgHxKZFxs/tL+aMkCK8R3yMwu4PcsVmiXBIVDDCvh/miEtMeE5UaEsNMJcN8o64\ng26PvPSXs9S+/zRHQtgtvLRFCb9blZpnYw/9Rb6RR3M3zxtiprFbyKYwipK1+uwlnIkSrbITUaJR\n1itKtMkGRYk2WRZAQbTNBpzWtggrrwnaWja00hk0DrCgsEZZ4hXWKksmwjLAHobkgOv+V3+ZhXHQ\niWxKqXYLKNyILDdqbPKlldASPhA+Mxc7uwatkSOSix1iP//q2APshLBvfJo7hbizgQj/mDtl+KYu\nCj8h7NSqCM2zXJvZwqqEY4uCOuGYLKEwJ3kVzMlyscg5915FTFbdqhaSVbn8+mTV1gmurOqCxpZN\nEeUu9BlZd1obioTkQ7IhPGTjYZuPIoUMK/GUFrX39asuHJTlH3w1d3FCBxCrCUufZX+NCUdPSsAq\nwu4A8wnPiQrFhW1Z4govFRWKCoeOjzjoZF92CdwpZy6AquoPvJRHJxB8bJ8AAAAASUVORK5CYII=\n"\n     style="image-rendering:optimizeQuality"\n     preserveAspectRatio="none"\n     height="13.76"\n     width="13.76" />\n</svg>\n';
      var le =
        '<?xml version="1.0" encoding="UTF-8" standalone="no"?>\n<svg\n   xmlns:dc="http://purl.org/dc/elements/1.1/"\n   xmlns:cc="http://creativecommons.org/ns#"\n   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"\n   xmlns:svg="http://www.w3.org/2000/svg"\n   xmlns="http://www.w3.org/2000/svg"\n   xmlns:xlink="http://www.w3.org/1999/xlink"\n   viewBox="0 0 13.76 13.76"\n   height="13.76"\n   width="13.76"\n   id="svg42"\n   version="1.1">\n  <metadata\n     id="metadata48">\n    <rdf:RDF>\n      <cc:Work\n         rdf:about="">\n        <dc:format>image/svg+xml</dc:format>\n        <dc:type\n           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />\n        <dc:title></dc:title>\n      </cc:Work>\n    </rdf:RDF>\n  </metadata>\n  <defs\n     id="defs46" />\n  <image\n     y="0"\n     x="0"\n     id="image50"\n     xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAArCAYAAADhXXHAAAAAAXNSR0IArs4c6QAAAARnQU1BAACx\njwv8YQUAAAAJcEhZcwAALiMAAC4jAXilP3YAAAG/SURBVFhH1ZgxUsMwEEUNJRyAGmp6qKGn5xRQ\nQ08NNfRQQw11DpAaanIAWrMv8WaELSlexhLLm/mRnImiF48jr7zVtm3zX9ju2ik5llxLdpdHNg4k\nT5I7yWB8Cdl9yZHkRmIRRpQxOxK+YzC+hKwSnTBBKKoMxpeUBSbkksgRE1V+CJeWhUPJ5ao7ICeq\nrIVryMKJpC88RlTZk1SThVDYIvoluZIsSqyz511SfEg4UxbRdw5qnlmFa9AsCn8hO4aBKHiUjYqC\nN9mkKHiSzYqCJ9lPSVIUPMmySqTudEu8XbOxO90ab7KQFPYoC1Fhr7IwENbagMLCUtXnoCTM1QZW\n3iS3dFT2mRfHvEjuVfZUckFnQh67dgqo1GYqC1MLn3XtZIR/sFcJW2C39FcD18KxpcutcGqddSmc\nuykg/LDq+iAnC/OudUFOVrfLbkjJWvb11YjJuhSFvqxbUQhlXYuCylpE2YXy2SkLlVEgaxVluzyT\nIEutWQ1kKZYtouF2maK4mjCyFN6bJsw9gKgmrNdsbsKNT0qEKsIqC7EJx4gqxYVDWQgntIgqRYXD\nbY3CLpcVgmdPC974BYy3/MgRNM03hR9ubFTHT48AAAAASUVORK5CYII=\n"\n     style="image-rendering:optimizeQuality"\n     preserveAspectRatio="none"\n     height="13.76"\n     width="13.76" />\n</svg>\n';
      var me = (function() {
        function e(t) {
          var n = this;
          ce(this, e);
          this.attributes = t;
          var i = navigator.userAgent.toLowerCase();
          var r = i.indexOf('android') > -1;
          var a = I.isIOS();
          this.iosSoftkeyboardOpened = false;
          this.iosMeasureUnit = i.indexOf('crios') === -1 ? '%' : 'vh';
          this.iosDivHeight = '100%'.concat(this.iosMeasureUnit);
          var o = window.outerWidth;
          var s = window.outerHeight;
          var l = o > s;
          var c = o < s;
          var u = l && this.attributes.height > s;
          var d = c && this.attributes.width > o;
          var m = u || d;
          this.instanceId = document.getElementsByClassName(
            'wrs_modal_dialogContainer'
          ).length;
          this.deviceProperties = {
            orientation: l ? 'landscape' : 'portait',
            isAndroid: r,
            isIOS: a,
            isMobile: m,
            isDesktop: !m && !a && !r,
          };
          this.properties = {
            created: false,
            state: '',
            previousState: '',
            position: { bottom: 0, right: 10 },
            size: { height: 338, width: 580 },
          };
          this.websiteBeforeLockParameters = null;
          var h = { class: 'wrs_modal_overlay' };
          h.id = this.getElementId(h.class);
          this.overlay = w.createElement('div', h);
          (h = {}).class = 'wrs_modal_title_bar';
          h.id = this.getElementId(h.class);
          this.titleBar = w.createElement('div', h);
          (h = {}).class = 'wrs_modal_title';
          h.id = this.getElementId(h.class);
          this.title = w.createElement('div', h);
          this.title.innerHTML = '';
          (h = {}).class = 'wrs_modal_close_button';
          h.id = this.getElementId(h.class);
          h.title = b.get('close');
          h.style = {};
          this.closeDiv = w.createElement('a', h);
          this.closeDiv.setAttribute('role', 'button');
          var g = 'background-size: 10px; background-image: url(data:image/svg+xml;base64,'.concat(
            window.btoa(te),
            ')'
          );
          var p = 'background-size: 10px; background-image: url(data:image/svg+xml;base64,'.concat(
            window.btoa(ne),
            ')'
          );
          this.closeDiv.setAttribute('style', g);
          this.closeDiv.setAttribute(
            'onmouseover',
            'this.style = "'.concat(p, '";')
          );
          this.closeDiv.setAttribute(
            'onmouseout',
            'this.style = "'.concat(g, '";')
          );
          (h = {}).class = 'wrs_modal_stack_button';
          h.id = this.getElementId(h.class);
          h.title = b.get('exit_fullscreen');
          this.stackDiv = w.createElement('a', h);
          this.stackDiv.setAttribute('role', 'button');
          g = 'background-size: 10px; background-image: url(data:image/svg+xml;base64,'.concat(
            window.btoa(se),
            ')'
          );
          p = 'background-size: 10px; background-image: url(data:image/svg+xml;base64,'.concat(
            window.btoa(le),
            ')'
          );
          this.stackDiv.setAttribute('style', g);
          this.stackDiv.setAttribute(
            'onmouseover',
            'this.style = "'.concat(p, '";')
          );
          this.stackDiv.setAttribute(
            'onmouseout',
            'this.style = "'.concat(g, '";')
          );
          (h = {}).class = 'wrs_modal_maximize_button';
          h.id = this.getElementId(h.class);
          h.title = b.get('fullscreen');
          this.maximizeDiv = w.createElement('a', h);
          this.maximizeDiv.setAttribute('role', 'button');
          g = 'background-size: 10px; background-repeat: no-repeat; background-image: url(data:image/svg+xml;base64,'.concat(
            window.btoa(ie),
            ')'
          );
          p = 'background-size: 10px; background-repeat: no-repeat; background-image: url(data:image/svg+xml;base64,'.concat(
            window.btoa(re),
            ')'
          );
          this.maximizeDiv.setAttribute('style', g);
          this.maximizeDiv.setAttribute(
            'onmouseover',
            'this.style = "'.concat(p, '";')
          );
          this.maximizeDiv.setAttribute(
            'onmouseout',
            'this.style = "'.concat(g, '";')
          );
          (h = {}).class = 'wrs_modal_minimize_button';
          h.id = this.getElementId(h.class);
          h.title = b.get('minimize');
          this.minimizeDiv = w.createElement('a', h);
          this.minimizeDiv.setAttribute('role', 'button');
          g = 'background-size: 10px; background-repeat: no-repeat; background-image: url(data:image/svg+xml;base64,'.concat(
            window.btoa(ae),
            ')'
          );
          p = 'background-size: 10px; background-repeat: no-repeat; background-image: url(data:image/svg+xml;base64,'.concat(
            window.btoa(oe),
            ')'
          );
          this.minimizeDiv.setAttribute('style', g);
          this.minimizeDiv.setAttribute(
            'onmouseover',
            'this.style = "'.concat(p, '";')
          );
          this.minimizeDiv.setAttribute(
            'onmouseout',
            'this.style = "'.concat(g, '";')
          );
          (h = {}).class = 'wrs_modal_dialogContainer';
          h.id = this.getElementId(h.class);
          h.role = 'dialog';
          this.container = w.createElement('div', h);
          this.container.setAttribute('aria-labeledby', 'wrs_modal_title[0]');
          (h = {}).class = 'wrs_modal_wrapper';
          h.id = this.getElementId(h.class);
          this.wrapper = w.createElement('div', h);
          (h = {}).class = 'wrs_content_container';
          h.id = this.getElementId(h.class);
          this.contentContainer = w.createElement('div', h);
          (h = {}).class = 'wrs_modal_controls';
          h.id = this.getElementId(h.class);
          this.controls = w.createElement('div', h);
          (h = {}).class = 'wrs_modal_buttons_container';
          h.id = this.getElementId(h.class);
          this.buttonContainer = w.createElement('div', h);
          this.submitButton = this.createSubmitButton(
            {
              id: this.getElementId('wrs_modal_button_accept'),
              class: 'wrs_modal_button_accept',
              innerHTML: b.get('accept'),
            },
            this.submitAction.bind(this)
          );
          this.cancelButton = this.createSubmitButton(
            {
              id: this.getElementId('wrs_modal_button_cancel'),
              class: 'wrs_modal_button_cancel',
              innerHTML: b.get('cancel'),
            },
            this.cancelAction.bind(this)
          );
          this.contentManager = null;
          var f = {
            cancelString: b.get('cancel'),
            submitString: b.get('close'),
            message: b.get('close_modal_warning'),
          };
          var v = {
            closeCallback: function() {
              n.close();
            },
            cancelCallback: function() {
              n.focus();
            },
          };
          var _ = { overlayElement: this.container, callbacks: v, strings: f };
          this.popup = new R(_);
          this.rtl = false;
          if ('rtl' in this.attributes) {
            this.rtl = this.attributes.rtl;
          }
          this.handleOpenedIosSoftkeyboard = this.handleOpenedIosSoftkeyboard.bind(
            this
          );
          this.handleClosedIosSoftkeyboard = this.handleClosedIosSoftkeyboard.bind(
            this
          );
        }
        de(e, [
          {
            key: 'setContentManager',
            value: function(e) {
              this.contentManager = e;
            },
          },
          {
            key: 'getContentManager',
            value: function() {
              return this.contentManager;
            },
          },
          {
            key: 'submitAction',
            value: function() {
              if (this.contentManager.submitAction !== void 0) {
                this.contentManager.submitAction();
              }
              this.close();
            },
          },
          {
            key: 'cancelAction',
            value: function() {
              if (this.contentManager.hasChanges === void 0) {
                this.close();
              } else if (this.contentManager.hasChanges()) {
                this.showPopUpMessage();
              } else {
                this.close();
              }
            },
          },
          {
            key: 'createSubmitButton',
            value: function(e, t) {
              return new ((function() {
                function n() {
                  ce(this, n);
                  this.element = document.createElement('button');
                  this.element.id = e.id;
                  this.element.className = e.class;
                  this.element.innerHTML = e.innerHTML;
                  w.addEvent(this.element, 'click', t);
                }
                de(n, [
                  {
                    key: 'getElement',
                    value: function() {
                      return this.element;
                    },
                  },
                ]);
                return n;
              })())(e, t).getElement();
            },
          },
          {
            key: 'create',
            value: function() {
              this.titleBar.appendChild(this.closeDiv);
              this.titleBar.appendChild(this.stackDiv);
              this.titleBar.appendChild(this.maximizeDiv);
              this.titleBar.appendChild(this.minimizeDiv);
              this.titleBar.appendChild(this.title);
              if (this.deviceProperties.isDesktop) {
                this.container.appendChild(this.titleBar);
              }
              this.wrapper.appendChild(this.contentContainer);
              this.wrapper.appendChild(this.controls);
              this.controls.appendChild(this.buttonContainer);
              this.buttonContainer.appendChild(this.submitButton);
              this.buttonContainer.appendChild(this.cancelButton);
              this.container.appendChild(this.wrapper);
              this.recalculateScrollBar();
              document.body.appendChild(this.container);
              document.body.appendChild(this.overlay);
              if (this.deviceProperties.isDesktop) {
                this.createModalWindowDesktop();
                this.createResizeButtons();
                this.addListeners();
                if (l.get('modalWindowFullScreen')) {
                  this.maximize();
                }
              } else if (this.deviceProperties.isAndroid) {
                this.createModalWindowAndroid();
              } else if (this.deviceProperties.isIOS) {
                this.createModalWindowIos();
              }
              if (this.contentManager != null) {
                this.contentManager.insert(this);
              }
              this.properties.open = true;
              this.properties.created = true;
              if (this.isRTL()) {
                this.container.style.right = ''.concat(
                  window.innerWidth -
                    this.scrollbarWidth -
                    this.container.offsetWidth,
                  'px'
                );
                this.container.className += ' wrs_modal_rtl';
              }
            },
          },
          {
            key: 'createResizeButtons',
            value: function() {
              this.resizerBR = document.createElement('div');
              this.resizerBR.className = 'wrs_bottom_right_resizer';
              this.resizerBR.innerHTML = '\u25E2';
              this.resizerTL = document.createElement('div');
              this.resizerTL.className = 'wrs_bottom_left_resizer';
              this.container.appendChild(this.resizerBR);
              this.titleBar.appendChild(this.resizerTL);
              w.addEvent(
                this.resizerBR,
                'mousedown',
                this.activateResizeStateBR.bind(this)
              );
              w.addEvent(
                this.resizerTL,
                'mousedown',
                this.activateResizeStateTL.bind(this)
              );
            },
          },
          {
            key: 'activateResizeStateBR',
            value: function(e) {
              this.initializeResizeProperties(e, false);
            },
          },
          {
            key: 'activateResizeStateTL',
            value: function(e) {
              this.initializeResizeProperties(e, true);
            },
          },
          {
            key: 'initializeResizeProperties',
            value: function(e, t) {
              w.addClass(document.body, 'wrs_noselect');
              w.addClass(this.overlay, 'wrs_overlay_active');
              this.resizeDataObject = {
                x: this.eventClient(e).X,
                y: this.eventClient(e).Y,
              };
              this.initialWidth = parseInt(this.container.style.width, 10);
              this.initialHeight = parseInt(this.container.style.height, 10);
              if (t) {
                this.leftScale = true;
              } else {
                this.initialRight = parseInt(this.container.style.right, 10);
                this.initialBottom = parseInt(this.container.style.bottom, 10);
              }
              if (!this.initialRight) {
                this.initialRight = 0;
              }
              if (!this.initialBottom) {
                this.initialBottom = 0;
              }
              document.body.style['user-select'] = 'none';
            },
          },
          {
            key: 'open',
            value: function() {
              var e = this;
              try {
                q
                  .send([
                    {
                      timestamp: new Date().toJSON(),
                      topic: '0',
                      level: 'info',
                      message: 'HELO telemetry.wiris.net',
                    },
                  ])
                  .then(function(e) {});
              } catch (e) {}
              this.removeClass('wrs_closed');
              var t = this.deviceProperties.isIOS;
              var n = this.deviceProperties.isAndroid;
              var i = this.deviceProperties.isMobile;
              if (t || n || i) {
                this.restoreWebsiteScale();
                this.lockWebsiteScroll();
                setTimeout(function() {
                  e.hideKeyboard();
                }, 400);
              }
              if (this.properties.created) {
                if (!this.properties.open) {
                  this.properties.open = true;
                  if (
                    !this.deviceProperties.isAndroid &&
                    !this.deviceProperties.isIOS
                  ) {
                    this.restoreState();
                  }
                }
                if (
                  this.deviceProperties.isDesktop &&
                  l.get('modalWindowFullScreen')
                ) {
                  this.maximize();
                }
                if (this.deviceProperties.isIOS) {
                  this.iosSoftkeyboardOpened = false;
                  this.setContainerHeight(''.concat(100 + this.iosMeasureUnit));
                }
              } else {
                this.create();
              }
              if (I.isEditorLoaded()) {
                this.contentManager.onOpen(this);
              } else {
                var r = m.newListener('onLoad', function() {
                  e.contentManager.onOpen(e);
                });
                this.contentManager.addListener(r);
              }
            },
          },
          {
            key: 'close',
            value: function() {
              ee.setTemporalImageToNull();
              this.removeClass('wrs_maximized');
              this.removeClass('wrs_minimized');
              this.removeClass('wrs_stack');
              this.addClass('wrs_closed');
              this.saveModalProperties();
              this.unlockWebsiteScroll();
              this.properties.open = false;
            },
          },
          {
            key: 'restoreWebsiteScale',
            value: function() {
              var e = document.querySelector('meta[name=viewport]');
              var t = ['initial-scale=', 'minimum-scale=', 'maximum-scale='];
              var n = ['1.0', '1.0', '1.0'];
              var i = function(e, t) {
                var i = e.getAttribute('content');
                if (i) {
                  var r = i.split(',');
                  var a = '';
                  var o = [];
                  for (var s = 0; s < r.length; s += 1) {
                    var l = false;
                    for (var c = 0; !l && c < t.length; ) {
                      if (r[s].indexOf(t[c])) {
                        l = true;
                      }
                      c += 1;
                    }
                    if (!l) {
                      o.push(r[s]);
                    }
                  }
                  for (var u = 0; u < t.length; u += 1) {
                    var d = t[u] + n[u];
                    a += u === 0 ? d : ','.concat(d);
                  }
                  for (var m = 0; m < o.length; m += 1) {
                    a += ','.concat(o[m]);
                  }
                  e.setAttribute('content', a);
                  e.setAttribute('content', '');
                  e.setAttribute('content', i);
                } else {
                  e.setAttribute(
                    'content',
                    'initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0'
                  );
                  e.removeAttribute('content');
                }
              };
              if (e) {
                i(e, t);
              } else {
                e = document.createElement('meta');
                document.getElementsByTagName('head')[0].appendChild(e);
                i(e, t);
                e.remove();
              }
            },
          },
          {
            key: 'lockWebsiteScroll',
            value: function() {
              this.websiteBeforeLockParameters = {
                bodyStylePosition: document.body.style.position
                  ? document.body.style.position
                  : '',
                bodyStyleOverflow: document.body.style.overflow
                  ? document.body.style.overflow
                  : '',
                htmlStyleOverflow: document.documentElement.style.overflow
                  ? document.documentElement.style.overflow
                  : '',
                windowScrollX: window.scrollX,
                windowScrollY: window.scrollY,
              };
            },
          },
          {
            key: 'unlockWebsiteScroll',
            value: function() {
              if (this.websiteBeforeLockParameters) {
                document.body.style.position = this.websiteBeforeLockParameters.bodyStylePosition;
                document.body.style.overflow = this.websiteBeforeLockParameters.bodyStyleOverflow;
                document.documentElement.style.overflow = this.websiteBeforeLockParameters.htmlStyleOverflow;
                var e = this.websiteBeforeLockParameters.windowScrollX;
                var t = this.websiteBeforeLockParameters.windowScrollY;
                window.scrollTo(e, t);
                this.websiteBeforeLockParameters = null;
              }
            },
          },
          {
            key: 'isIE11',
            value: function() {
              return (
                navigator.userAgent.search('Msie/') >= 0 ||
                navigator.userAgent.search('Trident/') >= 0 ||
                navigator.userAgent.search('Edge/') >= 0
              );
            },
          },
          {
            key: 'isRTL',
            value: function() {
              return (
                this.attributes.language === 'ar' ||
                this.attributes.language === 'he' ||
                this.rtl
              );
            },
          },
          {
            key: 'addClass',
            value: function(e) {
              w.addClass(this.overlay, e);
              w.addClass(this.titleBar, e);
              w.addClass(this.overlay, e);
              w.addClass(this.container, e);
              w.addClass(this.contentContainer, e);
              w.addClass(this.stackDiv, e);
              w.addClass(this.minimizeDiv, e);
              w.addClass(this.maximizeDiv, e);
              w.addClass(this.wrapper, e);
            },
          },
          {
            key: 'removeClass',
            value: function(e) {
              w.removeClass(this.overlay, e);
              w.removeClass(this.titleBar, e);
              w.removeClass(this.overlay, e);
              w.removeClass(this.container, e);
              w.removeClass(this.contentContainer, e);
              w.removeClass(this.stackDiv, e);
              w.removeClass(this.minimizeDiv, e);
              w.removeClass(this.maximizeDiv, e);
              w.removeClass(this.wrapper, e);
            },
          },
          {
            key: 'createModalWindowDesktop',
            value: function() {
              this.addClass('wrs_modal_desktop');
              this.stack();
            },
          },
          {
            key: 'createModalWindowAndroid',
            value: function() {
              this.addClass('wrs_modal_android');
              window.addEventListener(
                'resize',
                this.orientationChangeAndroidSoftkeyboard.bind(this)
              );
            },
          },
          {
            key: 'createModalWindowIos',
            value: function() {
              this.addClass('wrs_modal_ios');
              window.addEventListener(
                'resize',
                this.orientationChangeIosSoftkeyboard.bind(this)
              );
            },
          },
          {
            key: 'restoreState',
            value: function() {
              if (this.properties.state === 'maximized') {
                this.maximize();
              } else if (this.properties.state === 'minimized') {
                this.properties.state = this.properties.previousState;
                this.properties.previousState = '';
                this.minimize();
              } else {
                this.stack();
              }
            },
          },
          {
            key: 'stack',
            value: function() {
              this.properties.previousState = this.properties.state;
              this.properties.state = 'stack';
              this.removeClass('wrs_maximized');
              this.minimizeDiv.title = b.get('minimize');
              this.removeClass('wrs_minimized');
              this.addClass('wrs_stack');
              var e = 'background-size: 10px; background-repeat: no-repeat; background-image: url(data:image/svg+xml;base64,'.concat(
                window.btoa(ae),
                ')'
              );
              var t = 'background-size: 10px; background-repeat: no-repeat; background-image: url(data:image/svg+xml;base64,'.concat(
                window.btoa(oe),
                ')'
              );
              this.minimizeDiv.setAttribute('style', e);
              this.minimizeDiv.setAttribute(
                'onmouseover',
                'this.style = "'.concat(t, '";')
              );
              this.minimizeDiv.setAttribute(
                'onmouseout',
                'this.style = "'.concat(e, '";')
              );
              this.restoreModalProperties();
              if (this.resizerBR !== void 0 && this.resizerTL !== void 0) {
                this.setResizeButtonsVisibility();
              }
              this.recalculateScrollBar();
              this.recalculatePosition();
              this.recalculateScale();
              this.focus();
            },
          },
          {
            key: 'minimize',
            value: function() {
              this.saveModalProperties();
              this.title.style.cursor = 'pointer';
              if (
                this.properties.state === 'minimized' &&
                this.properties.previousState === 'stack'
              ) {
                this.stack();
              } else if (
                this.properties.state === 'minimized' &&
                this.properties.previousState === 'maximized'
              ) {
                this.maximize();
              } else {
                this.container.style.height = '30px';
                this.container.style.width = '250px';
                this.container.style.bottom = '0px';
                this.container.style.right = '10px';
                this.removeListeners();
                this.properties.previousState = this.properties.state;
                this.properties.state = 'minimized';
                this.setResizeButtonsVisibility();
                this.minimizeDiv.title = b.get('maximize');
                if (w.containsClass(this.overlay, 'wrs_stack')) {
                  this.removeClass('wrs_stack');
                } else {
                  this.removeClass('wrs_maximized');
                }
                this.addClass('wrs_minimized');
                var e = 'background-size: 10px; background-repeat: no-repeat; background-image: url(data:image/svg+xml;base64,'.concat(
                  window.btoa(
                    '<?xml version="1.0" encoding="UTF-8" standalone="no"?>\n<svg\n   xmlns:dc="http://purl.org/dc/elements/1.1/"\n   xmlns:cc="http://creativecommons.org/ns#"\n   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"\n   xmlns:svg="http://www.w3.org/2000/svg"\n   xmlns="http://www.w3.org/2000/svg"\n   xmlns:xlink="http://www.w3.org/1999/xlink"\n   viewBox="0 0 13.44 13.76"\n   height="13.76"\n   width="13.44"\n   id="svg3803"\n   version="1.1">\n  <metadata\n     id="metadata3809">\n    <rdf:RDF>\n      <cc:Work\n         rdf:about="">\n        <dc:format>image/svg+xml</dc:format>\n        <dc:type\n           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />\n        <dc:title></dc:title>\n      </cc:Work>\n    </rdf:RDF>\n  </metadata>\n  <defs\n     id="defs3807" />\n  <image\n     y="0"\n     x="0"\n     id="image3811"\n     xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACoAAAArCAYAAAAOnxr+AAAACXBIWXMAAC4jAAAuIwF4pT92AAAA\nvElEQVRYw+3ZSw0CMRSF4b8T9iAFB4wDkDAWcICEkTA4GAeAA3AADurgsCkbAgsSMrmFczZNd1/a\n3vSVJFFDGipJNdBZaRdAB2wC2TIwAgNAkrQEjsA86GBegDZJGoF18JnfJtVR9idXvaGGGmrod/b6\nV9kD14k9LbD6FDqUM8CU2b2Deo0aaqihhhpqqKGGGhr1hH/wiP469FaBMzflEhc9PZKQ1CtmsqRO\nEunpHbeNNN3A+dFJ/mf6V+gduGPIoUgKLbAAAAAASUVORK5CYII=\n"\n     style="image-rendering:optimizeQuality"\n     preserveAspectRatio="none"\n     height="13.76"\n     width="13.44" />\n</svg>\n'
                  ),
                  ')'
                );
                var t = 'background-size: 10px; background-repeat: no-repeat; background-image: url(data:image/svg+xml;base64,'.concat(
                  window.btoa(
                    '<?xml version="1.0" encoding="UTF-8" standalone="no"?>\n<svg\n   xmlns:dc="http://purl.org/dc/elements/1.1/"\n   xmlns:cc="http://creativecommons.org/ns#"\n   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"\n   xmlns:svg="http://www.w3.org/2000/svg"\n   xmlns="http://www.w3.org/2000/svg"\n   xmlns:xlink="http://www.w3.org/1999/xlink"\n   viewBox="0 0 13.44 13.76"\n   height="13.76"\n   width="13.44"\n   id="svg22"\n   version="1.1">\n  <metadata\n     id="metadata28">\n    <rdf:RDF>\n      <cc:Work\n         rdf:about="">\n        <dc:format>image/svg+xml</dc:format>\n        <dc:type\n           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />\n        <dc:title></dc:title>\n      </cc:Work>\n    </rdf:RDF>\n  </metadata>\n  <defs\n     id="defs26" />\n  <image\n     y="0"\n     x="0"\n     id="image30"\n     xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACoAAAArCAYAAAAOnxr+AAAACXBIWXMAAC4jAAAuIwF4pT92AAAA\nvUlEQVRYw+3ZsQ3CMBCF4d8WFekZgBqWIDUDZACmYBQWYIn0pGYAegZIexROERHRIBTdhXeVy08+\nyT4/JzMjQmWCVBjoarSugK0z3/0degKODjeyBy5Am8ysARrnnT8nM7sCa+fQLgdAAlQ6ngQVVFBB\nfzeUTK6t8VAwU328ztV6QQUVVFBBBRVUUEG9Ds41sJvZs/8GelDrlw7tAjhvmZLo9o6RD4bEGUp+\nX1My/I0T4HN4rrcASf9M/wp9ASNzIKYYz2hAAAAAAElFTkSuQmCC\n"\n     style="image-rendering:optimizeQuality"\n     preserveAspectRatio="none"\n     height="13.76"\n     width="13.44" />\n</svg>\n'
                  ),
                  ')'
                );
                this.minimizeDiv.setAttribute('style', e);
                this.minimizeDiv.setAttribute(
                  'onmouseover',
                  'this.style = "'.concat(t, '";')
                );
                this.minimizeDiv.setAttribute(
                  'onmouseout',
                  'this.style = "'.concat(e, '";')
                );
              }
            },
          },
          {
            key: 'maximize',
            value: function() {
              this.saveModalProperties();
              if (this.properties.state !== 'maximized') {
                this.properties.previousState = this.properties.state;
                this.properties.state = 'maximized';
              }
              this.setResizeButtonsVisibility();
              if (w.containsClass(this.overlay, 'wrs_minimized')) {
                this.minimizeDiv.title = b.get('minimize');
                this.removeClass('wrs_minimized');
              } else if (w.containsClass(this.overlay, 'wrs_stack')) {
                this.container.style.left = null;
                this.container.style.top = null;
                this.removeClass('wrs_stack');
              }
              this.addClass('wrs_maximized');
              var e = 'background-size: 10px; background-repeat: no-repeat; background-image: url(data:image/svg+xml;base64,'.concat(
                window.btoa(ae),
                ')'
              );
              var t = 'background-size: 10px; background-repeat: no-repeat; background-image: url(data:image/svg+xml;base64,'.concat(
                window.btoa(oe),
                ')'
              );
              this.minimizeDiv.setAttribute('style', e);
              this.minimizeDiv.setAttribute(
                'onmouseover',
                'this.style = "'.concat(t, '";')
              );
              this.minimizeDiv.setAttribute(
                'onmouseout',
                'this.style = "'.concat(e, '";')
              );
              this.setSize(
                parseInt(0.8 * window.innerHeight, 10),
                parseInt(0.8 * window.innerWidth, 10)
              );
              if (this.container.clientHeight > 700) {
                this.container.style.height = '700px';
              }
              if (this.container.clientWidth > 1200) {
                this.container.style.width = '1200px';
              }
              var n = window.innerHeight;
              var i = window.innerWidth;
              var r = n / 2 - this.container.offsetHeight / 2;
              var a = i / 2 - this.container.offsetWidth / 2;
              this.setPosition(r, a);
              this.recalculateScale();
              this.recalculatePosition();
              this.recalculateSize();
              this.focus();
            },
          },
          {
            key: 'reExpand',
            value: function() {
              if (this.properties.state === 'minimized') {
                if (this.properties.previousState === 'maximized') {
                  this.maximize();
                } else {
                  this.stack();
                }
                this.title.style.cursor = '';
              }
            },
          },
          {
            key: 'setSize',
            value: function(e, t) {
              this.container.style.height = ''.concat(e, 'px');
              this.container.style.width = ''.concat(t, 'px');
              this.recalculateSize();
            },
          },
          {
            key: 'setPosition',
            value: function(e, t) {
              this.container.style.bottom = ''.concat(e, 'px');
              this.container.style.right = ''.concat(t, 'px');
            },
          },
          {
            key: 'saveModalProperties',
            value: function() {
              if (this.properties.state === 'stack') {
                this.properties.position.bottom = parseInt(
                  this.container.style.bottom,
                  10
                );
                this.properties.position.right = parseInt(
                  this.container.style.right,
                  10
                );
                this.properties.size.width = parseInt(
                  this.container.style.width,
                  10
                );
                this.properties.size.height = parseInt(
                  this.container.style.height,
                  10
                );
              }
            },
          },
          {
            key: 'restoreModalProperties',
            value: function() {
              if (this.properties.state === 'stack') {
                this.setPosition(
                  this.properties.position.bottom,
                  this.properties.position.right
                );
                this.setSize(
                  this.properties.size.height,
                  this.properties.size.width
                );
              }
            },
          },
          {
            key: 'recalculateSize',
            value: function() {
              this.wrapper.style.width = ''.concat(
                this.container.clientWidth - 12,
                'px'
              );
              this.wrapper.style.height = ''.concat(
                this.container.clientHeight - 38,
                'px'
              );
              this.contentContainer.style.height = ''.concat(
                parseInt(this.wrapper.offsetHeight - 50, 10),
                'px'
              );
            },
          },
          {
            key: 'setResizeButtonsVisibility',
            value: function() {
              if (this.properties.state === 'stack') {
                this.resizerTL.style.visibility = 'visible';
                this.resizerBR.style.visibility = 'visible';
              } else {
                this.resizerTL.style.visibility = 'hidden';
                this.resizerBR.style.visibility = 'hidden';
              }
            },
          },
          {
            key: 'addListeners',
            value: function() {
              this.maximizeDiv.addEventListener(
                'click',
                this.maximize.bind(this),
                true
              );
              this.stackDiv.addEventListener(
                'click',
                this.stack.bind(this),
                true
              );
              this.minimizeDiv.addEventListener(
                'click',
                this.minimize.bind(this),
                true
              );
              this.closeDiv.addEventListener(
                'click',
                this.cancelAction.bind(this)
              );
              this.title.addEventListener('click', this.reExpand.bind(this));
              this.overlay.addEventListener(
                'click',
                this.cancelAction.bind(this)
              );
              w.addEvent(window, 'mousedown', this.startDrag.bind(this));
              w.addEvent(window, 'mouseup', this.stopDrag.bind(this));
              w.addEvent(window, 'mousemove', this.drag.bind(this));
              w.addEvent(window, 'resize', this.onWindowResize.bind(this));
              w.addEvent(this.container, 'keydown', this.onKeyDown.bind(this));
            },
          },
          {
            key: 'removeListeners',
            value: function() {
              w.removeEvent(window, 'mousedown', this.startDrag);
              w.removeEvent(window, 'mouseup', this.stopDrag);
              w.removeEvent(window, 'mousemove', this.drag);
              w.removeEvent(window, 'resize', this.onWindowResize);
              w.removeEvent(this.container, 'keydown', this.onKeyDown);
            },
          },
          {
            key: 'eventClient',
            value: function(e) {
              if (e.clientX === void 0 && e.changedTouches) {
                return {
                  X: e.changedTouches[0].clientX,
                  Y: e.changedTouches[0].clientY,
                };
              } else {
                return { X: e.clientX, Y: e.clientY };
              }
            },
          },
          {
            key: 'startDrag',
            value: function(e) {
              if (
                this.properties.state !== 'minimized' &&
                e.target === this.title
              ) {
                if (
                  this.dragDataObject === void 0 ||
                  this.dragDataObject === null
                ) {
                  this.dragDataObject = {
                    x: this.eventClient(e).X,
                    y: this.eventClient(e).Y,
                  };
                  this.lastDrag = { x: '0px', y: '0px' };
                  if (this.container.style.right === '') {
                    this.container.style.right = '0px';
                  }
                  if (this.container.style.bottom === '') {
                    this.container.style.bottom = '0px';
                  }
                  this.isIE11();
                  w.addClass(document.body, 'wrs_noselect');
                  w.addClass(this.overlay, 'wrs_overlay_active');
                  this.limitWindow = this.getLimitWindow();
                }
              }
            },
          },
          {
            key: 'drag',
            value: function(e) {
              if (this.dragDataObject) {
                e.preventDefault();
                var t = Math.min(
                  this.eventClient(e).Y,
                  this.limitWindow.minPointer.y
                );
                t = Math.max(this.limitWindow.maxPointer.y, t);
                var n = Math.min(
                  this.eventClient(e).X,
                  this.limitWindow.minPointer.x
                );
                n = Math.max(this.limitWindow.maxPointer.x, n);
                var i = ''.concat(n - this.dragDataObject.x, 'px');
                var r = ''.concat(t - this.dragDataObject.y, 'px');
                this.lastDrag = { x: i, y: r };
                this.container.style.transform = 'translate3d('
                  .concat(i, ',')
                  .concat(r, ',0)');
              }
              if (this.resizeDataObject) {
                var a;
                var o = window.innerWidth;
                var s = window.innerHeight;
                var l = Math.min(
                  this.eventClient(e).X,
                  o - this.scrollbarWidth - 7
                );
                var c = Math.min(this.eventClient(e).Y, s - 7);
                if (l < 0) {
                  l = 0;
                }
                if (c < 0) {
                  c = 0;
                }
                a = this.leftScale ? -1 : 1;
                this.container.style.width = ''.concat(
                  this.initialWidth + a * (l - this.resizeDataObject.x),
                  'px'
                );
                this.container.style.height = ''.concat(
                  this.initialHeight + a * (c - this.resizeDataObject.y),
                  'px'
                );
                if (!this.leftScale) {
                  if (this.resizeDataObject.x - l - this.initialWidth < -580) {
                    this.container.style.right = ''.concat(
                      this.initialRight - (l - this.resizeDataObject.x),
                      'px'
                    );
                  } else {
                    this.container.style.right = ''.concat(
                      this.initialRight + this.initialWidth - 580,
                      'px'
                    );
                    this.container.style.width = '580px';
                  }
                  if (this.resizeDataObject.y - c < this.initialHeight - 338) {
                    this.container.style.bottom = ''.concat(
                      this.initialBottom - (c - this.resizeDataObject.y),
                      'px'
                    );
                  } else {
                    this.container.style.bottom = ''.concat(
                      this.initialBottom + this.initialHeight - 338,
                      'px'
                    );
                    this.container.style.height = '338px';
                  }
                }
                this.recalculateScale();
                this.recalculatePosition();
              }
            },
          },
          {
            key: 'getLimitWindow',
            value: function() {
              var e = window.innerWidth;
              var t = window.innerHeight;
              var n = this.container.offsetHeight;
              var i = parseInt(this.container.style.bottom, 10);
              var r = parseInt(this.container.style.right, 10);
              var a = window.pageXOffset;
              var o = this.dragDataObject.y;
              var s = this.dragDataObject.x;
              var l = n + i - (t - (o - a));
              var c = e - this.scrollbarWidth - (s - a) - r;
              var u = t - this.container.offsetHeight + l;
              var d = this.title.offsetHeight - (this.title.offsetHeight - l);
              return {
                minPointer: { x: e - c - this.scrollbarWidth, y: u },
                maxPointer: { x: this.container.offsetWidth - c, y: d },
              };
            },
          },
          {
            key: 'getScrollBarWidth',
            value: function() {
              var e = document.createElement('p');
              e.style.width = '100%';
              e.style.height = '200px';
              var t = document.createElement('div');
              t.style.position = 'absolute';
              t.style.top = '0px';
              t.style.left = '0px';
              t.style.visibility = 'hidden';
              t.style.width = '200px';
              t.style.height = '150px';
              t.style.overflow = 'hidden';
              t.appendChild(e);
              document.body.appendChild(t);
              var n = e.offsetWidth;
              t.style.overflow = 'scroll';
              var i = e.offsetWidth;
              if (n === i) {
                i = t.clientWidth;
              }
              document.body.removeChild(t);
              return n - i;
            },
          },
          {
            key: 'stopDrag',
            value: function() {
              if (this.dragDataObject || this.resizeDataObject) {
                this.container.style.transform = '';
                if (this.dragDataObject) {
                  this.container.style.right = ''.concat(
                    parseInt(this.container.style.right, 10) -
                      parseInt(this.lastDrag.x, 10),
                    'px'
                  );
                  this.container.style.bottom = ''.concat(
                    parseInt(this.container.style.bottom, 10) -
                      parseInt(this.lastDrag.y, 10),
                    'px'
                  );
                }
                this.focus();
                document.body.style['user-select'] = '';
                this.isIE11();
                w.removeClass(document.body, 'wrs_noselect');
                w.removeClass(this.overlay, 'wrs_overlay_active');
              }
              this.dragDataObject = null;
              this.resizeDataObject = null;
              this.initialWidth = null;
              this.leftScale = null;
            },
          },
          {
            key: 'onWindowResize',
            value: function() {
              this.recalculateScrollBar();
              this.recalculatePosition();
              this.recalculateScale();
            },
          },
          {
            key: 'onKeyDown',
            value: function(e) {
              if (e.key !== void 0) {
                if (this.popup.overlayWrapper.style.display === 'block') {
                  this.popup.onKeyDown(e);
                } else if (e.key === 'Escape' || e.key === 'Esc') {
                  if (this.properties.open) {
                    this.contentManager.onKeyDown(e);
                  }
                } else if (e.shiftKey && e.key === 'Tab') {
                  if (document.activeElement === this.cancelButton) {
                    this.submitButton.focus();
                    e.stopPropagation();
                    e.preventDefault();
                  } else {
                    this.contentManager.onKeyDown(e);
                  }
                } else if (e.key === 'Tab') {
                  if (document.activeElement === this.submitButton) {
                    this.cancelButton.focus();
                    e.stopPropagation();
                    e.preventDefault();
                  } else {
                    this.contentManager.onKeyDown(e);
                  }
                }
              }
            },
          },
          {
            key: 'recalculatePosition',
            value: function() {
              this.container.style.right = ''.concat(
                Math.min(
                  parseInt(this.container.style.right, 10),
                  window.innerWidth -
                    this.scrollbarWidth -
                    this.container.offsetWidth
                ),
                'px'
              );
              if (parseInt(this.container.style.right, 10) < 0) {
                this.container.style.right = '0px';
              }
              this.container.style.bottom = ''.concat(
                Math.min(
                  parseInt(this.container.style.bottom, 10),
                  window.innerHeight - this.container.offsetHeight
                ),
                'px'
              );
              if (parseInt(this.container.style.bottom, 10) < 0) {
                this.container.style.bottom = '0px';
              }
            },
          },
          {
            key: 'recalculateScale',
            value: function() {
              var e = false;
              if (parseInt(this.container.style.width, 10) > 580) {
                this.container.style.width = ''.concat(
                  Math.min(
                    parseInt(this.container.style.width, 10),
                    window.innerWidth - this.scrollbarWidth
                  ),
                  'px'
                );
                e = true;
              } else {
                this.container.style.width = '580px';
                e = true;
              }
              if (parseInt(this.container.style.height, 10) > 338) {
                this.container.style.height = ''.concat(
                  Math.min(
                    parseInt(this.container.style.height, 10),
                    window.innerHeight
                  ),
                  'px'
                );
                e = true;
              } else {
                this.container.style.height = '338px';
                e = true;
              }
              if (e) {
                this.recalculateSize();
              }
            },
          },
          {
            key: 'recalculateScrollBar',
            value: function() {
              this.hasScrollBar =
                window.innerWidth > document.documentElement.clientWidth;
              if (this.hasScrollBar) {
                this.scrollbarWidth = this.getScrollBarWidth();
              } else {
                this.scrollbarWidth = 0;
              }
            },
          },
          {
            key: 'hideKeyboard',
            value: function() {
              var e = document.createElement('input');
              this.container.appendChild(e);
              e.focus();
              e.blur();
              e.remove();
            },
          },
          {
            key: 'focus',
            value: function() {
              if (
                this.contentManager != null &&
                this.contentManager.onFocus !== void 0
              ) {
                this.contentManager.onFocus();
              }
            },
          },
          {
            key: 'portraitMode',
            value: function() {
              return window.innerHeight > window.innerWidth;
            },
          },
          {
            key: 'handleOpenedIosSoftkeyboard',
            value: function() {
              if (
                !this.iosSoftkeyboardOpened &&
                this.iosDivHeight != null &&
                this.iosDivHeight === '100'.concat(this.iosMeasureUnit)
              ) {
                if (this.portraitMode()) {
                  this.setContainerHeight('63'.concat(this.iosMeasureUnit));
                } else {
                  this.setContainerHeight('40'.concat(this.iosMeasureUnit));
                }
              }
              this.iosSoftkeyboardOpened = true;
            },
          },
          {
            key: 'handleClosedIosSoftkeyboard',
            value: function() {
              this.iosSoftkeyboardOpened = false;
              this.setContainerHeight('100'.concat(this.iosMeasureUnit));
            },
          },
          {
            key: 'orientationChangeIosSoftkeyboard',
            value: function() {
              if (this.iosSoftkeyboardOpened) {
                if (this.portraitMode()) {
                  this.setContainerHeight('63'.concat(this.iosMeasureUnit));
                } else {
                  this.setContainerHeight('40'.concat(this.iosMeasureUnit));
                }
              } else {
                this.setContainerHeight('100'.concat(this.iosMeasureUnit));
              }
            },
          },
          {
            key: 'orientationChangeAndroidSoftkeyboard',
            value: function() {
              this.setContainerHeight('100%');
            },
          },
          {
            key: 'setContainerHeight',
            value: function(e) {
              this.iosDivHeight = e;
              this.wrapper.style.height = e;
            },
          },
          {
            key: 'showPopUpMessage',
            value: function() {
              if (this.properties.state === 'minimized') {
                this.stack();
              }
              this.popup.show();
            },
          },
          {
            key: 'setTitle',
            value: function(e) {
              this.title.innerHTML = e;
            },
          },
          {
            key: 'getElementId',
            value: function(e) {
              return ''.concat(e, '[').concat(this.instanceId, ']');
            },
          },
        ]);
        return e;
      })();
      if (!String.prototype.codePointAt) {
        (function() {
          var e = function(e) {
            if (this == null) {
              throw TypeError();
            }
            var t = String(this);
            var n = t.length;
            var i = e ? Number(e) : 0;
            if (i != i) {
              i = 0;
            }
            if (!(i < 0) && !(i >= n)) {
              var r;
              var a = t.charCodeAt(i);
              if (
                a >= 55296 &&
                a <= 56319 &&
                n > i + 1 &&
                (r = t.charCodeAt(i + 1)) >= 56320 &&
                r <= 57343
              ) {
                return 1024 * (a - 55296) + r - 56320 + 65536;
              } else {
                return a;
              }
            }
          };
          if (Object.defineProperty) {
            Object.defineProperty(String.prototype, 'codePointAt', {
              value: e,
              configurable: true,
              writable: true,
            });
          } else {
            String.prototype.codePointAt = e;
          }
        })();
      }
      if (typeof Object.assign != 'function') {
        Object.defineProperty(Object, 'assign', {
          value: function(e, t) {
            if (e == null) {
              throw new TypeError('Cannot convert undefined or null to object');
            }
            var n = Object(e);
            for (var i = 1; i < arguments.length; i++) {
              var r = arguments[i];
              if (r != null) {
                for (var a in r) {
                  if (Object.prototype.hasOwnProperty.call(r, a)) {
                    n[a] = r[a];
                  }
                }
              }
            }
            return n;
          },
          writable: true,
          configurable: true,
        });
      }
      n(3);
      var ge = (function() {
        function e(t) {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
          this.language = 'en';
          this.editMode = 'images';
          this.modalDialog = null;
          this.customEditors = new z();
          this.customEditors.addEditor('chemistry', {
            name: 'Chemistry',
            toolbar: 'chemistry',
            icon: 'chem.png',
            confVariable: 'chemEnabled',
            title: 'ChemType',
            tooltip: 'Insert a chemistry formula - ChemType',
          });
          this.environment = {};
          this.editionProperties = {};
          this.editionProperties.isNewElement = true;
          this.editionProperties.temporalImage = null;
          this.editionProperties.latexRange = null;
          this.editionProperties.range = null;
          this.integrationModel = null;
          this.contentManager = null;
          this.browser = (function() {
            var e = navigator.userAgent;
            var t = 'none';
            if (e.search('Edge/') >= 0) {
              t = 'EDGE';
            } else if (e.search('Chrome/') >= 0) {
              t = 'CHROME';
            } else if (e.search('Trident/') >= 0) {
              t = 'IE';
            } else if (e.search('Firefox/') >= 0) {
              t = 'FIREFOX';
            } else if (e.search('Safari/') >= 0) {
              t = 'SAFARI';
            }
            return t;
          })();
          this.listeners = new m();
          this.serviceProviderProperties = {};
          if (!('serviceProviderProperties' in t)) {
            throw new Error('serviceProviderProperties property missing.');
          }
          this.serviceProviderProperties = t.serviceProviderProperties;
        }
        (function(e, t, n) {
          if (t) {
            he(e.prototype, t);
          }
          if (n) {
            he(e, n);
          }
        })(
          e,
          [
            {
              key: 'setIntegrationModel',
              value: function(e) {
                this.integrationModel = e;
              },
            },
            {
              key: 'setEnvironment',
              value: function(e) {
                if ('editor' in e) {
                  this.environment.editor = e.editor;
                }
                if ('mode' in e) {
                  this.environment.mode = e.mode;
                }
                if ('version' in e) {
                  this.environment.version = e.version;
                }
              },
            },
            {
              key: 'getModalDialog',
              value: function() {
                return this.modalDialog;
              },
            },
            {
              key: 'init',
              value: function() {
                var t = this;
                if (e.initialized) {
                  this.listeners.fire('onLoad', {});
                } else {
                  var n = m.newListener('onInit', function() {
                    var e = g.getService('configurationjs', '', 'get');
                    var n = JSON.parse(e);
                    l.addConfiguration(n);
                    l.addConfiguration(L);
                    b.language = t.language;
                    t.listeners.fire('onLoad', {});
                  });
                  g.addListener(n);
                  g.init(this.serviceProviderProperties);
                  e.initialized = true;
                }
              },
            },
            {
              key: 'addListener',
              value: function(e) {
                this.listeners.add(e);
              },
            },
            {
              key: 'beforeUpdateFormula',
              value: function(t, n) {
                var i = new N();
                i.mathml = t;
                i.wirisProperties = {};
                if (n != null) {
                  Object.keys(n).forEach(function(e) {
                    i.wirisProperties[e] = n[e];
                  });
                }
                i.language = this.language;
                i.editMode = this.editMode;
                if (this.listeners.fire('onBeforeFormulaInsertion', i)) {
                  return {};
                } else if (
                  e.globalListeners.fire('onBeforeFormulaInsertion', i)
                ) {
                  return {};
                } else {
                  return {
                    mathml: i.mathml,
                    wirisProperties: i.wirisProperties,
                  };
                }
              },
            },
            {
              key: 'insertFormula',
              value: function(e, t, n, i) {
                var r = {};
                if (n) {
                  if (this.editMode === 'latex') {
                    r.latex = f.getLatexFromMathML(n);
                    if (this.integrationModel.fillNonLatexNode && !r.latex) {
                      var a = new N();
                      a.editMode = this.editMode;
                      a.windowTarget = t;
                      a.focusElement = e;
                      a.latex = r.latex;
                      this.integrationModel.fillNonLatexNode(a, t, n);
                    } else {
                      r.node = t.document.createTextNode(
                        '$$'.concat(r.latex, '$$')
                      );
                    }
                    this.insertElementOnSelection(r.node, e, t);
                  } else {
                    r.node = T.mathmlToImgObject(
                      t.document,
                      n,
                      i,
                      this.language
                    );
                    this.insertElementOnSelection(r.node, e, t);
                  }
                } else {
                  this.insertElementOnSelection(null, e, t);
                }
                return r;
              },
            },
            {
              key: 'afterUpdateFormula',
              value: function(t, n, i, r) {
                var a = new N();
                a.editMode = this.editMode;
                a.windowTarget = n;
                a.focusElement = t;
                a.node = i;
                a.latex = r;
                if (this.listeners.fire('onAfterFormulaInsertion', a)) {
                  return {};
                } else {
                  e.globalListeners.fire('onAfterFormulaInsertion', a);
                  return {};
                }
              },
            },
            {
              key: 'placeCaretAfterNode',
              value: function(e) {
                this.integrationModel.getSelection();
                var t = e.ownerDocument;
                if (t.getSelection !== void 0 && e.parentElement) {
                  var n = t.createRange();
                  n.setStartAfter(e);
                  n.collapse(true);
                  var i = t.getSelection();
                  i.removeAllRanges();
                  i.addRange(n);
                  t.body.focus();
                }
              },
            },
            {
              key: 'insertElementOnSelection',
              value: function(e, t, n) {
                if (this.editionProperties.isNewElement) {
                  if (e) {
                    if (t.type === 'textarea') {
                      w.updateTextArea(t, e.textContent);
                    } else if (
                      document.selection &&
                      document.getSelection === 0
                    ) {
                      var i = n.document.selection.createRange();
                      n.document.execCommand('InsertImage', false, e.src);
                      if (!('parentElement' in i)) {
                        n.document.execCommand('delete', false);
                        i = n.document.selection.createRange();
                        n.document.execCommand('InsertImage', false, e.src);
                      }
                      if ('parentElement' in i) {
                        var r = i.parentElement();
                        if (r.nodeName.toUpperCase() === 'IMG') {
                          r.parentNode.replaceChild(e, r);
                        } else {
                          i.pasteHTML(w.createObjectCode(e));
                        }
                      }
                    } else {
                      var a = this.integrationModel.getSelection();
                      var o = null;
                      if (this.editionProperties.range) {
                        o = this.editionProperties.range;
                        this.editionProperties.range = null;
                      } else {
                        o = a.getRangeAt(0);
                      }
                      o.deleteContents();
                      var s = o.startContainer;
                      var l = o.startOffset;
                      if (s.nodeType === 3) {
                        (s = s.splitText(l)).parentNode.insertBefore(e, s);
                      } else if (s.nodeType === 1) {
                        s.insertBefore(e, s.childNodes[l]);
                      }
                      this.placeCaretAfterNode(e);
                    }
                  } else if (t.type === 'textarea') {
                    t.focus();
                  } else {
                    var c = this.integrationModel.getSelection();
                    c.removeAllRanges();
                    if (this.editionProperties.range) {
                      var u = this.editionProperties.range;
                      this.editionProperties.range = null;
                      c.addRange(u);
                    }
                  }
                } else if (this.editionProperties.latexRange) {
                  if (document.selection && document.getSelection === 0) {
                    this.editionProperties.isNewElement = true;
                    this.editionProperties.latexRange.select();
                    this.insertElementOnSelection(e, t, n);
                  } else {
                    this.editionProperties.latexRange.deleteContents();
                    this.editionProperties.latexRange.insertNode(e);
                    this.placeCaretAfterNode(e);
                  }
                } else if (t.type === 'textarea') {
                  var d;
                  d =
                    this.integrationModel.getSelectedItem !== void 0
                      ? this.integrationModel.getSelectedItem(t, false)
                      : w.getSelectedItemOnTextarea(t);
                  w.updateExistingTextOnTextarea(
                    t,
                    e.textContent,
                    d.startPosition,
                    d.endPosition
                  );
                } else {
                  if (e && e.nodeName.toLowerCase() === 'img') {
                    k.removeImgDataAttributes(
                      this.editionProperties.temporalImage
                    );
                    k.clone(e, this.editionProperties.temporalImage);
                  } else {
                    this.editionProperties.temporalImage.remove();
                  }
                  this.placeCaretAfterNode(
                    this.editionProperties.temporalImage
                  );
                }
              },
            },
            {
              key: 'openModalDialog',
              value: function(e, t) {
                var n;
                var i = this;
                this.editMode = 'images';
                try {
                  if (t) {
                    e.contentWindow.focus();
                    var r = e.contentWindow.getSelection();
                    this.editionProperties.range = r.getRangeAt(0);
                  } else {
                    e.focus();
                    var a = getSelection();
                    this.editionProperties.range = a.getRangeAt(0);
                  }
                } catch (e) {
                  this.editionProperties.range = null;
                }
                if (t === void 0) {
                  t = true;
                }
                this.editionProperties.latexRange = null;
                if (e) {
                  if (
                    (n =
                      this.integrationModel.getSelectedItem !== void 0
                        ? this.integrationModel.getSelectedItem(e, t)
                        : w.getSelectedItem(e, t))
                  ) {
                    if (
                      !n.caretPosition &&
                      w.containsClass(n.node, l.get('imageClassName'))
                    ) {
                      this.editionProperties.temporalImage = n.node;
                      this.editionProperties.isNewElement = false;
                    } else if (n.node.nodeType === 3) {
                      if (this.integrationModel.getMathmlFromTextNode) {
                        var s = this.integrationModel.getMathmlFromTextNode(
                          n.node,
                          n.caretPosition
                        );
                        if (s) {
                          this.editMode = 'latex';
                          this.editionProperties.isNewElement = false;
                          this.editionProperties.temporalImage = document.createElement(
                            'img'
                          );
                          this.editionProperties.temporalImage.setAttribute(
                            l.get('imageMathmlAttribute'),
                            o.safeXmlEncode(s)
                          );
                        }
                      } else {
                        var c = f.getLatexFromTextNode(n.node, n.caretPosition);
                        if (c) {
                          var u = f.getMathMLFromLatex(c.latex);
                          this.editMode = 'latex';
                          this.editionProperties.isNewElement = false;
                          this.editionProperties.temporalImage = document.createElement(
                            'img'
                          );
                          this.editionProperties.temporalImage.setAttribute(
                            l.get('imageMathmlAttribute'),
                            o.safeXmlEncode(u)
                          );
                          var d = t ? e.contentWindow : window;
                          if (e.tagName.toLowerCase() !== 'textarea') {
                            if (document.selection) {
                              var h = 0;
                              for (var g = c.startNode.previousSibling; g; ) {
                                h += w.getNodeLength(g);
                                g = g.previousSibling;
                              }
                              this.editionProperties.latexRange = d.document.selection.createRange();
                              this.editionProperties.latexRange.moveToElementText(
                                c.startNode.parentNode
                              );
                              this.editionProperties.latexRange.move(
                                'character',
                                h + c.startPosition
                              );
                              this.editionProperties.latexRange.moveEnd(
                                'character',
                                c.latex.length + 4
                              );
                            } else {
                              this.editionProperties.latexRange = d.document.createRange();
                              this.editionProperties.latexRange.setStart(
                                c.startNode,
                                c.startPosition
                              );
                              this.editionProperties.latexRange.setEnd(
                                c.endNode,
                                c.endPosition
                              );
                            }
                          }
                        }
                      }
                    }
                  } else if (e.tagName.toLowerCase() === 'textarea') {
                    this.editMode = 'latex';
                  }
                }
                var p = l.get('editorAttributes').split(', ');
                var v = {};
                var _ = 0;
                for (var b = p.length; _ < b; _ += 1) {
                  var y = p[_].split('=');
                  var x = y[0];
                  var k = y[1];
                  v[x] = k;
                }
                var A = {};
                var C = l.get('editorParameters');
                var M = this.integrationModel.editorParameters;
                Object.assign(A, v, C);
                Object.assign(A, v, M);
                A.language = this.language;
                A.rtl = this.integrationModel.rtl;
                var T = {};
                T.editorAttributes = A;
                T.language = this.language;
                T.customEditors = this.customEditors;
                T.environment = this.environment;
                if (this.modalDialog == null) {
                  this.modalDialog = new me(A);
                  this.contentManager = new I(T);
                  var E = m.newListener('onLoad', function() {
                    i.contentManager.isNewElement =
                      i.editionProperties.isNewElement;
                    if (i.editionProperties.temporalImage != null) {
                      var e = o.safeXmlDecode(
                        i.editionProperties.temporalImage.getAttribute(
                          l.get('imageMathmlAttribute')
                        )
                      );
                      i.contentManager.mathML = e;
                    }
                  });
                  this.contentManager.addListener(E);
                  this.contentManager.init();
                  this.modalDialog.setContentManager(this.contentManager);
                  this.contentManager.setModalDialogInstance(this.modalDialog);
                } else if (
                  ((this.contentManager.isNewElement = this.editionProperties.isNewElement),
                  this.editionProperties.temporalImage != null)
                ) {
                  var j = o.safeXmlDecode(
                    this.editionProperties.temporalImage.getAttribute(
                      l.get('imageMathmlAttribute')
                    )
                  );
                  this.contentManager.mathML = j;
                }
                this.contentManager.setIntegrationModel(this.integrationModel);
                this.modalDialog.open();
              },
            },
            {
              key: 'getCustomEditors',
              value: function() {
                return this.customEditors;
              },
            },
          ],
          [
            {
              key: 'addGlobalListener',
              value: function(t) {
                e.globalListeners.add(t);
              },
            },
            {
              key: 'globalListeners',
              get: function() {
                return e._globalListeners;
              },
              set: function(t) {
                e._globalListeners = t;
              },
            },
            {
              key: 'initialized',
              get: function() {
                return e._initialized;
              },
              set: function(t) {
                e._initialized = t;
              },
            },
          ]
        );
        return e;
      })();
      ge._globalListeners = new m();
      ge._initialized = false;
      window.wrs_addPluginListener = function(e) {
        var t;
        console.warn('Deprecated method');
        var n = e[(t = Object.keys(e)[0])];
        var i = m.newListener(t, n);
        ge.addGlobalListener(i);
      };
      window.wrs_initParse = function(e, t) {
        console.warn('Deprecated method. Use Parser.endParse instead.');
        return T.initParse(e, t);
      };
      window.wrs_endParse = function(e, t, n) {
        console.warn('Deprecated method. Use Parser.endParse instead.');
        return T.endParse(e, t, n);
      };
      var pe = n(1);
      var xe = (function(e) {
        function n(e) {
          var i;
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, n);
          (i = t.call(this, e)).integrationFolderName = 'ckeditor_wiris';
          return i;
        }
        (function() {
          var e = n;
          var t = ee;
          if (typeof t != 'function' && t !== null) {
            throw new TypeError(
              'Super expression must either be null or a function'
            );
          }
          e.prototype = Object.create(t && t.prototype, {
            constructor: { value: e, writable: true, configurable: true },
          });
          if (t) {
            be(e, t);
          }
        })();
        var t = ye(n);
        (function(e, t, n) {
          if (t) {
            ve(e.prototype, t);
          }
          if (n) {
            ve(e, n);
          }
        })(n, [
          {
            key: 'init',
            value: function() {
              _e(we(n.prototype), 'init', this).call(this);
              var e = this.editorObject;
              if ('wiriseditorparameters' in e.config) {
                l.update('editorParameters', e.config.wiriseditorparameters);
              }
            },
          },
          {
            key: 'getLanguage',
            value: function() {
              try {
                return this.editorParameters.language;
              } catch (e) {}
              if (this.editorObject.langCode == null) {
                return _e(we(n.prototype), 'getLanguage', this).call(this);
              } else {
                return this.editorObject.langCode;
              }
            },
          },
          {
            key: 'getPath',
            value: function() {
              return this.editorObject.plugins.ckeditor_wiris.path;
            },
          },
          {
            key: 'addEditorListeners',
            value: function() {
              var e = this.editorObject;
              if (
                e.config.wirislistenersdisabled !== void 0 &&
                e.config.wirislistenersdisabled
              ) {
                e.on(
                  'instanceReady',
                  function(e) {
                    this.checkElement();
                  }.bind(this)
                );
                e.resetDirty();
              } else {
                e.setData(T.initParse(e.getData()));
                e.on('focus', function(e) {
                  WirisPlugin.currentInstance =
                    WirisPlugin.instances[e.editor.name];
                });
                e.on(
                  'contentDom',
                  function() {
                    e.on(
                      'doubleclick',
                      function(e) {
                        if (
                          (e.data.element.$.nodeName.toLowerCase() == 'img' &&
                            w.containsClass(
                              e.data.element.$,
                              l.get('imageClassName')
                            )) ||
                          w.containsClass(
                            e.data.element.$,
                            l.get('CASClassName')
                          )
                        ) {
                          e.data.dialog = null;
                        }
                      }.bind(this)
                    );
                    this.addEvents();
                  }.bind(this)
                );
                e.on(
                  'setData',
                  function(e) {
                    e.data.dataValue = T.initParse(e.data.dataValue || '');
                  }.bind(this)
                );
                e.on(
                  'afterSetData',
                  function(e) {
                    if (T.observer !== void 0) {
                      Array.prototype.forEach.call(
                        document.getElementsByClassName('Wirisformula'),
                        function(e) {
                          T.observer.observe(e);
                        }
                      );
                    }
                  }.bind(this)
                );
                e.on(
                  'getData',
                  function(e) {
                    e.data.dataValue = T.endParse(e.data.dataValue || '');
                  }.bind(this)
                );
                e.on(
                  'mode',
                  function(e) {
                    this.checkElement();
                  }.bind(this)
                );
                this.checkElement();
              }
            },
          },
          {
            key: 'checkElement',
            value: function() {
              var e;
              var t = this.editorObject;
              var n = document.getElementById('cke_contents_' + t.name)
                ? document.getElementById('cke_contents_' + t.name)
                : document.getElementById('cke_' + t.name);
              var i = false;
              if (
                !(e =
                  t.elementMode == CKEDITOR.ELEMENT_MODE_INLINE
                    ? t.container.$
                    : n.getElementsByTagName('iframe')[0])
              ) {
                var r;
                for (var a in n.classList) {
                  var o = n.classList[a];
                  if (o.search('cke_\\d') != -1) {
                    r = o;
                    break;
                  }
                }
                if (r) {
                  i = true;
                  (e = document.getElementById(
                    r + '_contents'
                  )).wirisActive = false;
                }
              }
              if (!e.wirisActive) {
                if (t.elementMode === CKEDITOR.ELEMENT_MODE_INLINE) {
                  if (e.tagName === 'TEXTAREA') {
                    var s = document.getElementsByClassName(
                      'cke_textarea_inline'
                    );
                    Array.prototype.forEach.call(s, function(e) {
                      this.setTarget(e);
                      this.addEvents();
                    });
                  } else {
                    this.setTarget(e);
                    this.addEvents();
                  }
                  e.wirisActive = true;
                } else if (e.contentWindow || i) {
                  this.setTarget(e);
                  this.addEvents();
                  e.wirisActive = true;
                }
              }
            },
          },
          {
            key: 'doubleClickHandler',
            value: function(e, t) {
              if (
                e.nodeName.toLowerCase() == 'img' &&
                w.containsClass(e, l.get('imageClassName'))
              ) {
                if (t.stopPropagation === void 0) {
                  t.returnValue = false;
                } else {
                  t.stopPropagation();
                }
                this.core.getCustomEditors().disable();
                var n = e.getAttribute(l.get('imageCustomEditorName'));
                if (n) {
                  this.core.getCustomEditors().enable(n);
                }
                this.core.editionProperties.temporalImage = e;
                this.openExistingFormulaEditor();
              }
            },
          },
          {
            key: 'insertFormula',
            value: function(e, t, i, r) {
              var a = _e(we(n.prototype), 'insertFormula', this).call(
                this,
                e,
                t,
                i,
                r
              );
              this.editorObject.fire('change');
              return a;
            },
          },
          {
            key: 'getCorePath',
            value: function() {
              return CKEDITOR.plugins.getPath(this.integrationFolderName);
            },
          },
          {
            key: 'getSelection',
            value: function() {
              this.editorObject.editable().$.focus();
              return this.editorObject.getSelection().getNative();
            },
          },
          {
            key: 'callbackFunction',
            value: function() {
              _e(we(n.prototype), 'callbackFunction', this).call(this);
              this.addEditorListeners();
            },
          },
        ]);
        return n;
      })();
      CKEDITOR.plugins.add('ckeditor_wiris', {
        init: function(e) {
          e.ui.addButton('ckeditor_wiris_formulaEditor', {
            label: 'Insert a math equation - MathType',
            command: 'ckeditor_wiris_openFormulaEditor',
            icon:
              CKEDITOR.plugins.getPath('ckeditor_wiris') +
              './icons/formula.png',
          });
          e.ui.addButton('ckeditor_wiris_formulaEditorChemistry', {
            label: 'Insert a chemistry formula - ChemType',
            command: 'ckeditor_wiris_openFormulaEditorChemistry',
            icon:
              CKEDITOR.plugins.getPath('ckeditor_wiris') + './icons/chem.png',
          });
          var t = 'img[align,';
          t += l.get('imageMathmlAttribute');
          t += ',src,alt](!Wirisformula)';
          e.addCommand('ckeditor_wiris_openFormulaEditor', {
            async: false,
            canUndo: true,
            editorFocus: true,
            allowedContent: t,
            requiredContent: t,
            exec: function(e) {
              var t = WirisPlugin.instances[e.name];
              t.core.getCustomEditors().disable();
              t.openNewFormulaEditor();
            },
          });
          e.addCommand('ckeditor_wiris_openFormulaEditorChemistry', {
            async: false,
            canUndo: true,
            editorFocus: true,
            allowedContent: t,
            requiredContent: t,
            exec: function(e) {
              var t = WirisPlugin.instances[e.name];
              t.core.getCustomEditors().enable('chemistry');
              t.openNewFormulaEditor();
            },
          });
          e.on('instanceReady', function() {
            var t = {};
            t.editorObject = e;
            t.target = e.container.$.querySelector('*[class^=cke_wysiwyg]');
            t.serviceProviderProperties = {};
            t.serviceProviderProperties.URI = 'integration';
            t.serviceProviderProperties.server = 'php';
            t.version = pe.a;
            t.scriptName = 'plugin.js';
            t.environment = {};
            t.environment.editor = 'CKEditor4';
            t.environment.editorVersion = '4.x';
            if ('wiriscontextpath' in e.config) {
              t.configurationService =
                e.config.wiriscontextpath + t.configurationService;
              console.warn(
                'Deprecated property wiriscontextpath. Use mathTypeParameters on instead.',
                e.config.wiriscontextpath
              );
            }
            if ('mathTypeParameters' in e.config) {
              t.integrationParameters = e.config.mathTypeParameters;
            }
            var n = new xe(t);
            n.init();
            n.listeners.fire('onTargetReady', {});
            WirisPlugin.instances[e.name] = n;
            WirisPlugin.currentInstance = n;
          });
        },
      });
      var Ae = (function() {
        function e() {
          (function(e, t) {
            if (!(e instanceof t)) {
              throw new TypeError('Cannot call a class as a function');
            }
          })(this, e);
        }
        (function(e, t, n) {
          if (t) {
            ke(e.prototype, t);
          }
          if (n) {
            ke(e, n);
          }
        })(e, null, [
          {
            key: 'init',
            value: function() {
              e.testServices();
            },
          },
          {
            key: 'testServices',
            value: function() {
              var e;
              console.log('Testing configuration service...');
              console.log(g.getService('configurationjs', '', 'get'));
              console.log('Testing showimage service...');
              (e = []).mml =
                '<math xmlns="http://www.w3.org/1998/Math/MathML"><msup><mi>x</mi><mn>2</mn></msup></math>';
              console.log(g.getService('showimage', e));
              console.log('Testing createimage service...');
              (e = []).mml =
                '<math xmlns="http://www.w3.org/1998/Math/MathML"><msup><mi>x</mi><mn>2</mn></msup></math>';
              console.log(g.getService('createimage', e, 'post'));
              console.log('Testing MathML2Latex service...');
              (e = []).service = 'mathml2latex';
              e.mml =
                '<math xmlns="http://www.w3.org/1998/Math/MathML"><msup><mi>x</mi><mn>2</mn></msup></math>';
              console.log(g.getService('service', e));
              console.log('Testing Latex2MathML service...');
              (e = []).service = 'latex2mathml';
              e.latex = 'x^2';
              console.log(g.getService('service', e));
              console.log('Testing Mathml2Accesible service...');
              (e = []).service = 'mathml2accessible';
              e.mml =
                '<math xmlns="http://www.w3.org/1998/Math/MathML"><msup><mi>x</mi><mn>2</mn></msup></math>';
              console.log(g.getService('service', e));
            },
          },
        ]);
        return e;
      })();
      window.WirisPlugin = {
        Core: ge,
        Parser: T,
        Image: k,
        Util: w,
        Configuration: l,
        Listeners: m,
        IntegrationModel: ee,
        currentInstance: null,
        instances: {},
        CKEditor4Integration: xe,
        Latex: f,
        Test: Ae,
      };
    },
  ];
  var t = {};
  n.m = e;
  n.c = t;
  n.d = function(e, t, i) {
    if (!n.o(e, t)) {
      Object.defineProperty(e, t, { enumerable: true, get: i });
    }
  };
  n.r = function(e) {
    if (typeof Symbol != 'undefined' && Symbol.toStringTag) {
      Object.defineProperty(e, Symbol.toStringTag, { value: 'Module' });
    }
    Object.defineProperty(e, '__esModule', { value: true });
  };
  n.t = function(e, t) {
    if (1 & t) {
      e = n(e);
    }
    if (8 & t) {
      return e;
    }
    if (4 & t && typeof e == 'object' && e && e.__esModule) {
      return e;
    }
    var i = Object.create(null);
    n.r(i);
    Object.defineProperty(i, 'default', { enumerable: true, value: e });
    if (2 & t && typeof e != 'string') {
      for (var r in e) {
        n.d(
          i,
          r,
          function(t) {
            return e[t];
          }.bind(null, r)
        );
      }
    }
    return i;
  };
  n.n = function(e) {
    var t =
      e && e.__esModule
        ? function() {
            return e.default;
          }
        : function() {
            return e;
          };
    n.d(t, 'a', t);
    return t;
  };
  n.o = function(e, t) {
    return Object.prototype.hasOwnProperty.call(e, t);
  };
  n.p = '';
  n((n.s = 8));
})();
