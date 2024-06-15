import { store } from '@wordpress/notices';
import { useState, useEffect } from '@wordpress/element';
import { useDispatch } from '@wordpress/data';
import apiFetch from '@wordpress/api-fetch';
import { __ } from '@wordpress/i18n';
import {
	Panel,
	PanelBody,
	Flex,
	FlexItem,
	Button,
	ToggleControl,
} from '@wordpress/components';

import Notices from './Notices.js';

const SettingsPage = () => {
	const [ checkAll, setCheckAll ] = useState( false );
	const [ allPlugins, setAllPlugins ] = useState( [] );
	const [ pluginsStatus, setPluginsStatus ] = useState( [] );

	const { createSuccessNotice, createErrorNotice } = useDispatch( store );

	useEffect( () => {
		apiFetch( { path: '/wp/v2/settings' } ).then( ( settings ) => {
			setPluginsStatus(
				settings.youbou_show_hooks_settings.pluginsStatus
			);
		} );

		apiFetch( { path: '/wp/v2/plugins' } ).then( ( plugins ) => {
			setAllPlugins( plugins );
		} );
	}, [] );

	const PluginsToggles = () => {
		const content = allPlugins.map( ( plugin ) => {
			if ( plugin.status !== 'active' ) {
				return null;
			}

			const status = pluginsStatus[ plugin.plugin ] ?? '0';

			return (
				<FlexItem key={ plugin.plugin }>
					<ToggleControl
						label={ plugin.name }
						onChange={ () => changeStatus( plugin.plugin ) }
						checked={ status === '1' }
					/>
				</FlexItem>
			);
		} );

		return content;
	};

	const changeStatus = ( slug ) => {
		const newValue = pluginsStatus[ slug ] === '1' ? '0' : '1';
		setPluginsStatus( { ...pluginsStatus, [ slug ]: newValue } );
	};

	const changeAll = ( e ) => {
		setCheckAll( ! checkAll );

		allPlugins.map( ( plugin ) => {
			if ( plugin.status !== 'active' ) {
				return null;
			}

			pluginsStatus[ plugin.plugin ] = e ? '1' : '0';
			return null;
		} );
	};

	const saveSettings = () => {
		apiFetch( {
			path: '/wp/v2/settings',
			method: 'POST',
			data: {
				youbou_show_hooks_settings: {
					pluginsStatus,
				},
			},
		} )
			.then( () => {
				createSuccessNotice(
					__( 'Settings saved.', 'youbou-show-hooks' )
				);
			} )
			.catch( () => {
				createErrorNotice(
					__( 'Error saving settings.', 'youbou-show-hooks' )
				);
			} );
	};

	return (
		<>
			<Notices />
			<Panel header={ __( 'Settings', 'youbou-show-hooks' ) }>
				<PanelBody>
					<ToggleControl
						label={ __( 'All', 'youbou-show-hooks' ) }
						onChange={ changeAll }
						checked={ checkAll }
					/>
					<Flex wrap={ true } justify="start">
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
