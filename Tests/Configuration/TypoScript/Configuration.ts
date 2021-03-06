### Include this file to configure TYPO3 for the manual tests and the correct Virtual Object Page setup
# <INCLUDE_TYPOSCRIPT: source="FILE:EXT:rest/Tests/Configuration/TypoScript/Configuration.ts">
#
# Virtual Object Page setup for TYPO3 < 9
# <INCLUDE_TYPOSCRIPT: source="FILE:EXT:rest/Configuration/TypoScript/Page/TYPO3-8/setup.txt">

# Virtual Object Page setup for TYPO3 >= 9
# <INCLUDE_TYPOSCRIPT: source="FILE:EXT:rest/Configuration/TypoScript/Page/TYPO3-9/setup.txt">

<INCLUDE_TYPOSCRIPT: source="FILE:EXT:rest/Configuration/TypoScript/Content/setup.txt">

plugin.tx_rest.settings {
    paths {
        virtual_object-content {
            path = virtual_object-content
            read = allow
            write = allow
        }

        virtual_object-page {
            path = virtual_object-page
            read = allow
            write = allow
        }

        cundd-custom_rest-route {
            path = cundd-custom_rest-route
            read = allow
            write = allow
        }

        cundd-custom_rest-require {
            path = cundd-custom_rest-require
            read = require
            write = require
        }

        georgringer-news {
            path = georg_ringer-news-*
            read = allow
            write = allow
        }
    }

    aliases {
        customhandler = cundd-custom_rest-custom_handler
    }
}
