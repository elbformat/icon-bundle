// Inspired by https://codepen.io/giannisrig/pen/ywBWOV
window.addEventListener('load', function() {
   document.querySelectorAll('.elbformat-icon-select').forEach((iconDropdown) => {
      // Hidden field to carry the form data
      let hiddenField = document.createElement('input');
      hiddenField.setAttribute('type','hidden');
      hiddenField.setAttribute('name', iconDropdown.getAttribute('name'));
      let value = iconDropdown.value || '';
      hiddenField.setAttribute('value', value);
      iconDropdown.after(hiddenField);

      // Wrapper for new widget
      let wrapper = document.createElement('div');
      wrapper.classList.add('icon-dropdown-wrapper');
      iconDropdown.after(wrapper);

      let button = document.createElement('button');
      button.classList.add('icon-dropdown-trigger');
      wrapper.appendChild(button);
      let iconList = document.createElement('div');
      iconList.classList.add('icon-dropdown-list');
      wrapper.appendChild(iconList);

      // Extract icons
      let items = JSON.parse(iconDropdown.getAttribute('data-choices'));
      for (const [key, tmpl] of Object.entries(items)) {
         let container = document.createElement('button');
         container.setAttribute('value', key)
         let iconContainer = document.createElement('div');
         iconContainer.classList.add('icon-container');
         iconContainer.innerHTML = tmpl;
         container.appendChild(iconContainer);
         container.innerHTML+=key
         iconList.appendChild(container);
         if (value===key) {
            button.innerHTML = container.innerHTML;
         }
         // Click on entry
         container.addEventListener('click',(e) => {
            button.innerHTML = container.innerHTML;
            hiddenField.value = key;
            wrapper.classList.remove('open');
            e.preventDefault();
            return false;
         });
      };

      // Open/Close
      button.addEventListener('click',(e) => {
         if (wrapper.classList.contains('open')) {
            wrapper.classList.remove('open');
         } else {
            wrapper.classList.add('open');
         }
         e.preventDefault();
         return false;
      });
   });

});