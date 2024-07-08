document.addEventListener('DOMContentLoaded', function(){
    const subcategoriaSelect = document.getElementById('subcategoria');
    const searchSubcategoria = document.getElementById('searchSubcategoria');
    const urlInput = document.getElementById('url');
    const claseinput = document.getElementById('clase');
    const claseinput2 = document.getElementById('clase2');

    subcategoriaSelect.addEventListener('change', function() {
        const selectedOption = subcategoriaSelect.options[subcategoriaSelect.selectedIndex];
        const url = selectedOption.getAttribute('data-url');
        urlInput.value = url;
        const clase = selectedOption.getAttribute('data-clase');
        claseinput.value = clase;
        claseinput2.value = clase;
    });

    subcategoriaSelect.dispatchEvent(new Event('change'));

    searchSubcategoria.addEventListener('input', function(){
        const filter = searchSubcategoria.value.toLowerCase();
        const options = subcategoriaSelect.options;
        let firstVisibleOption = null;

        for (let i = 0; i < options.length; i++) {
            const option = options[i];
            const text = option.text.toLowerCase();

            if (text.startsWith(filter)) {
                option.style.display = "";
                if (firstVisibleOption === null) {
                    firstVisibleOption = option;
                }
            } else {
                option.style.display = "none";
            }
        }

        if (firstVisibleOption) {
            subcategoriaSelect.value = firstVisibleOption.value;
            subcategoriaSelect.dispatchEvent(new Event('change'));
        } else {
            subcategoriaSelect.value = "";
        }
    });
});