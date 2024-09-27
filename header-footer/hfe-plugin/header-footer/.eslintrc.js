/**
 * Internal dependencies
 */

module.exports = {
	root: true,
	extends: [
		'plugin:@wordpress/eslint-plugin/recommended-with-formatting',
		'plugin:import/recommended',
		'plugin:eslint-comments/recommended',
	],
	env: {
		browser: true,
	},
	parserOptions: {
		requireConfigFile: false,
		babelOptions: {
			presets: [ require.resolve( '@wordpress/babel-preset-default' ) ],
		},
	},
	overrides: [
		{
			files: [
				'tests/e2e/**/*.js',
			],
			extends: [
				'plugin:@wordpress/eslint-plugin/test-e2e',
				'plugin:jest/all',
			],
			settings: {
				jest: {
					version: 26,
				},
			},
			rules: {
				'jest/lowercase-name': [
					'error',
					{
						ignore: [
							'describe',
						],
					},
				],
				'jest/no-hooks': 'off',
				'jest/prefer-expect-assertions': 'off',
				'jest/prefer-inline-snapshots': 'off',
			},
		},
	],
};
