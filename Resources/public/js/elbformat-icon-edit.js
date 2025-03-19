window.addEventListener('load', function() {
   // Find list entries
   document.querySelectorAll('.elbformat-icon-select').forEach((iconDropdownEntry) => {
      let value = iconDropdownEntry.value || '';
      let iconMarkup =  iconDropdownEntry.getAttribute('data-markup');
      let li = iconDropdownEntry.closest('.ibexa-dropdown').querySelector('.ibexa-dropdown__item[data-value="'+value+'"]');

      // Create a span with icon
      let wrapper = document.createElement('span');
      wrapper.classList.add('ibexa-icon');
      wrapper.classList.add('ibexa-icon--small');
      wrapper.innerHTML =iconMarkup;

      // Insert before the label
      let label = li.querySelector('.ibexa-dropdown__item-label');
      li.insertBefore(wrapper, label);

      // @todo also update the selected choice with an icon
   });

});