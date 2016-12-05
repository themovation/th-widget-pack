<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Team extends Widget_Base {

	public function get_name() {
		return 'themo-team';
	}

	public function get_title() {
		return __( 'Team', 'elementor' );
	}

	public function get_icon() {
		return 'person';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_about',
			[
				'label' => __( 'About', 'elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter title here', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'content',
			[
				'label' => __( 'Content', 'elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);

		$this->add_control(
			'job',
			[
				'label' => __( 'Job Title', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'CEO', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_link',
			[
				'label' => __( 'Link', 'elementor' ),
			]
		);

		$this->add_control(
			'url',
			[
				'label' => __( 'Link URL', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'default' => [
					'url' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'lightbox',
			[
				'label' => __( 'Lightbox', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'off' => __( 'Off', 'elementor' ),
					'on' => __( 'On', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'lightbox_width',
			[
				'label' => __( 'Lightbox width (px)', 'elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
				'condition' => [
					'lightbox!' => 'off',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'Image', 'elementor' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social',
			[
				'label' => __( 'Social Icons', 'elementor' ),
			]
		);

		$this->add_control(
			'social',
			[
				'label' => __( 'Social Icons', 'elementor' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'url' => 'http://your-link.com'
					]
				],
				'fields' => [
					[
						'name' => 'icon',
						'label' => __( 'Icon', 'elementor' ),
						'type' => Controls_Manager::ICON,
						'default' => '',
						'label_block' => true,
					],
					[
						'name' => 'graphic_image',
						'label' => __( 'Graphic Image', 'elementor' ),
						'type' => Controls_Manager::MEDIA,
						'default' => '',
						'label_block' => true,
					],
					[
						'name' => 'url',
						'label' => __( 'Link URL', 'elementor' ),
						'type' => Controls_Manager::URL,
						'placeholder' => 'http://your-link.com',
						'default' => [
							'url' => '',
						],
						'separator' => 'before',
						'label_block' => true,
					],
					[
						'name' => 'lightbox',
						'label' => __( 'Lightbox', 'elementor' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'off',
						'options' => [
							'off' => __( 'Off', 'elementor' ),
							'on' => __( 'On', 'elementor' ),
						],
						'label_block' => true,
					],
					[
						'name' => 'lightbox_width',
						'label' => __( 'Lightbox width (px)', 'elementor' ),
						'type' => Controls_Manager::NUMBER,
						'default' => '',
						'label_block' => true,
					]
				],
				'title_field' => '<i class="{{ icon }}"></i> {{{ url }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Background', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-team-member-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_contrast',
			[
				'label' => __( 'Contrast', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'dark',
				'options' => [
					'dark' => __( 'Dark Text', 'elementor' ),
					'light' => __( 'Light Text', 'elementor' ),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		$this->add_render_attribute('th-team-member','class', 'th-' . $settings['background_contrast'] . '-text');

		if ( ! empty( $settings['url']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['url']['url'] );

			if ( ! empty( $settings['url']['is_external'] ) ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['lightbox'] != 'off' ) {
				$this->add_render_attribute( 'link', 'data-toggle', 'lightbox' );
			}

			if ( $settings['lightbox'] != 'off' && $settings['lightbox_width'] ) {
				$this->add_render_attribute( 'link', 'data-width', $settings['lightbox_width'] );
			}
		}

		if ( empty( $settings['title'] ) ) {
			return;
		} else {
			$title = '<h4>' . esc_html( $settings['title'] ) . '</h4>';
		}

		if ( $settings['image']['id'] ) $image = wp_get_attachment_image( $settings['image']['id'], 'th_img_sm_portrait', false, array( 'class' => 'th-team-member-image' ) );
		?>

		<div class="th-team-member">
			<div class="th-team-member-wrap">
				<?php if ( ! empty( $settings['url']['url'] ) ) : ?>
					<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
						<?php echo $image . '' . $title; ?>
					</a>
				<?php else : ?>
					<?php echo $image . '' . $title; ?>
				<?php endif; ?>
				<?php if ( ! empty( $settings['job'] ) ) : ?>
					<h5><?php echo esc_html( $settings['job']) ?></h5>
				<?php endif;?>
				<?php if ( ! empty( $settings['content'] ) ) : ?>
					<div class="th-team-member-bio">
						<?php echo $settings['content']; ?>
					</div>
				<?php endif; ?>
				<div class="th-team-member-social">
					<?php foreach( $settings['social'] as $social ) {
						if ( ! empty( $social['url']['url'] ) ) {
							$target = $social['url']['is_external'] ? ' target="_blank"' : '';
							$lightbox = ( $social['lightbox'] != 'off' ) ? 'data-toggle="lightbox"' : '';
							$lightbox_width = ( $social['lightbox_width'] && $social['lightbox'] != 'off' ) ? 'data-width="' . esc_html( $social['lightbox_width'] ) . '"' : '';

							echo '<a href="' . $social['url']['url'] . '"' . $target . ' ' . $lightbox . ' ' . $lightbox_width . '>';
						}
							if ( $social['graphic_image']['id'] ) :
								wp_get_attachment_image( $social['graphic_image']['id'], 'full', false, array( 'class' => 'th-icon th-icon-graphic' ) );
							elseif ( $social['icon'] ) : ?>
								<i class="<?php echo esc_attr( $social['icon'] ); ?>"></i>
							<?php endif;
						if ( ! empty( $social['url']['url'] ) ) {
							echo '</a>';
						}
					} ?>
				</div>
			</div>
		</div>

		<?php
	}

	protected function _content_template() {
		?>
		<div class="th-team-member 'th-' + settings'background_contrast' + '-text'">
			<div class="th-team-member-wrap">
				<# if ( settings.url && settings.url.url ) { #>
					<a href="{{ settings.url.url }}">
				<# } #>
					<# if ( settings.image && '' !== settings.image.url ) { #>
						<img src="{{{ settings.image.url }}}" class="th-team-member-image" />
					<# } #>
					<# if ( '' !== settings.title ) { #>
						<h4>{{{ settings.title }}}</h4>
					<# } #>
				<# if ( settings.url && settings.url.url ) { #>
					</a>
				<# } #>
				<# if ( '' !== settings.job ) { #>
					<h5>{{{ settings.job }}}</h5>
				<# } #>
				<# if ( '' !== settings.content ) { #>
					<div class="th-team-member-bio">
						{{{ settings.content }}}
					</div>
				<# } #>
				<div class="th-team-member-social">
					<#
					if ( settings.social ) {
						_.each( settings.social, function( item ) { #>
							<# if ( item.url && item.url.url ) { #>
								<a href="{{ item.url.url }}">
							<# } #>
								<# if ( item.image && item.image.url ) { #>
									<img src="{{{ item.image.url }}}" class="th-icon th-icon-graphic" />
								<# } #>
								<# if ( item.icon ) { #>
									<i class="{{ item.icon }}"></i>
								<# } #>
							<# if ( item.link && item.link.url ) { #>
								</a>
							<# } #>
						<#
						} );
					} #>
				</div>
			</div>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Team() );
