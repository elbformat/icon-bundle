// See https://doc.ibexa.co/en/3.3/extending/import_assets_from_bundle/#configuration-from-main-project-files
const path = require('path');

module.exports = (eZConfig, eZConfigManager) => {
    // Edit
    eZConfigManager.add({
        eZConfig,
        entryName: 'ezplatform-admin-ui-content-edit-parts-js',
        newItems: [
            path.resolve(__dirname, '../public/js/elbformat-icon-edit.js')
        ]
    });
    eZConfigManager.add({
        eZConfig,
        entryName: 'ezplatform-admin-ui-content-edit-parts-css',
        newItems: [
            path.resolve(__dirname, '../public/css/elbformat-icon-edit.css')
        ]
    });
    // Preview
    eZConfigManager.add({
        eZConfig,
        entryName: 'ezplatform-admin-ui-layout-css',
        newItems: [
            path.resolve(__dirname, '../public/css/elbformat-icon-preview.css')
        ]
    });

};