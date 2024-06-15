import domReady from '@wordpress/dom-ready';
import { createRoot } from '@wordpress/element';

import SettingsPage from './components/SettingsPage';

import '../scss/admin-settings.scss';

domReady( () => {
	const root = createRoot( document.getElementById( 'youbou-show-hooks' ) );
	root.render( <SettingsPage /> );
} );
