<?php
/**
 * AMP plugin to disable site scan.
 *
 * @package   Google\AMP_Site_Scan_Disable
 * @author    thelovekesh <lovekesh.kumar@rtcamp.com>
 * @license   GPL-2.0-or-later
 * @copyright 2022 Google Inc.
 *
 * @wordpress-plugin
 * Plugin Name: AMP Site Scan Disable
 * Plugin URI: https://github.com/ampproject/amp-wp
 * Description: A WordPress plugin to disable site scan on plugins or themes activation page.
 * Version: 1.0.0
 * Author: AMP Project Contributors
 * Author URI: https://github.com/ampproject/amp-wp/graphs/contributors
 * License: GNU General Public License v2 (or later)
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Google\AMP_Site_Scan_Disable;

/**
 * Class AMP_Site_Scan_Disable
 *
 * @package Google\AMP_Site_Scan_Disable
 */
class AMP_Site_Scan_Disable {
	/**
	 * Handle for JS file.
	 *
	 * @var string
	 */
	const ASSET_HANDLE = 'amp-site-scan-notice';

	/**
	 * Init
	 */
	public function init() {
		add_action( 'admin_enqueue_scripts', [ $this, 'dequeue_amp_site_scan_notice_scripts' ], 11 );
	}

	/**
	 * Dequeue asset admin script for AMP site scan notice
	 *
	 * @param string $hook page url where scripts are loaded.
	 */
	public function dequeue_amp_site_scan_notice_scripts( $hook ) {
		if ( ! function_exists( 'amp_is_enabled' ) && \amp_is_enabled() ) {
			return;
		}

		if ( 'plugins.php' === $hook || 'themes.php' === $hook ) {
			wp_dequeue_script( self::ASSET_HANDLE );
		}
	}
}


( new AMP_Site_Scan_Disable() )->init();
