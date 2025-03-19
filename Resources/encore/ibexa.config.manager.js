// See https://doc.ibexa.co/en/3.3/extending/import_assets_from_bundle/#configuration-from-main-project-files
const path = require('path');

module.exports = (ibexaConfig, ibexaConfigManager) => {
    // Edit
    ibexaConfigManager.add({
        ibexaConfig,
        entryName: 'ibexa-admin-ui-content-edit-parts-js',
        newItems: [
            path.resolve(__dirname, '../public/js/elbformat-icon-edit.js')
        ]
    });
    // Preview
    ibexaConfigManager.add({
        ibexaConfig,
        entryName: 'ibexa-admin-ui-layout-css',
        newItems: [
            path.resolve(__dirname, '../public/css/elbformat-icon-preview.css')
        ]
    });

};