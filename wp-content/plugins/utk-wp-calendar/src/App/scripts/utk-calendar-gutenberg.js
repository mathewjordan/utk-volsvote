var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    blockStyle = {
        backgroundColor: '#f8f9f9',
        fontSize: '13px',
        fontFamily: '-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif',
        fontWeight: '600',
        textAlign: 'center',
        color: '#191e23',
        padding: '23px'
    };

registerBlockType( 'utk-calendar-gutenberg/listing', {

    title: 'UT Event Calendar',
    icon: 'calendar',
    category: 'layout',

    attributes: {
        content: {
            type: 'string',
            source: 'html',
            selector: 'p',
        },

        numberAttribute: {
            type: 'number',
        }
    },

    edit: function() {
        return el(
             'p', { style: blockStyle }, 'University of Tennessee Event Calendar'
        );
    },

    save: function() {
        return null;
    },

});