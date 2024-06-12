import { store } from '@wordpress/notices';
import { useState, useEffect } from '@wordpress/element';
import { useDispatch } from '@wordpress/data';
import apiFetch from '@wordpress/api-fetch';
import { __ } from '@wordpress/i18n';
import {
    Panel,
    PanelBody,
    PanelRow,
    SelectControl,
    Flex,
    FlexBlock,
    FlexItem,
    TextareaControl,
    Button,
    ToggleControl
} from '@wordpress/components';

import Notices from './Notices.js';

const SettingsPage = () => {

    const [ message, setMessage ] = useState('');
    const [ plugins, setPlugins ] = useState([]);
    const [ pluginsStatus, setPluginsStatus ] = useState([]);

    const { createSuccessNotice, createErrorNotice } = useDispatch( store );

    useEffect( () => {
        apiFetch( { path: '/wp/v2/settings' } ).then( ( settings ) => {
            setPluginsStatus( settings.youbou_show_hooks_settings.pluginsStatus );
            setMessage( settings.youbou_show_hooks_settings.message );
        } );

        apiFetch( { path: '/wp/v2/plugins' } ).then( ( plugins ) => {

            plugins.forEach( ( plugin ) => {
                console.log( plugin );
                // plugin.active = pluginsStatus[ plugin.slug ] || false;
            } );
            setPlugins( plugins );
        } );
    }, [] );

    const PluginsToggles = () => {
        const content = plugins.map( plugin =>
            <FlexItem key={plugin.plugin}>
                <ToggleControl
                    label={plugin.name}
                    onChange={function noRefCheck() {}}
                    checked={ plugin.active }
                />
            </FlexItem>
        );

        return content;
    };

    const saveSettings = () => {
        apiFetch( {
            path: '/wp/v2/settings',
            method: 'POST',
            data: {
                youbou_show_hooks_settings: {
                    message,
                },
            },
        } ).then( () => {
            createSuccessNotice(
                __( 'Settings saved.', 'youbou-show-hooks' ),
            );
        } ).catch( () => {
            createErrorNotice(
                __( 'Error saving settings.', 'youbou-show-hooks' ),
            );
        } );
    };
    
    return (
        <>
        <Notices />
        <Panel header={__('Settings', 'youbou-show-hooks')}>
            <PanelBody>
                <ToggleControl
                    label={__('All', 'youbou-show-hooks')}
                    onChange={function noRefCheck() {}}
                    checked
                />
                <Flex wrap={true} justify='start'>
                    <PluginsToggles />
                </Flex>
            </PanelBody>
        </Panel>
        <Button variant="primary" onClick={ saveSettings }>
            { __( 'Save', 'unadorned-announcement-bar' ) }
        </Button>
        </>
    );
};

export default SettingsPage;
