<?php

class Slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'ihcoderdov_slider';
	}

	public function get_title() {
		return __( 'Slider', 'ihcoderdov' );
	}

	public function get_icon() {
		return 'fa fa-slideshare';
	}

	public function get_categories() {
		return [ 'ihcoderdov' ];
	}

	protected function _register_controls() {

		// Slider Content
		$this->start_controls_section(
			'slider_section_content',
			[
				'label' => __( 'Slider Content', 'ihcoderdov' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ihcoderdov_gallery',
			[
				'label' => __( 'Add Images', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);

		$this->end_controls_section();

		// Slider Opction
		$this->start_controls_section(
			'slider_section',
			[
				'label' => __( 'Slider Opctions', 'ihcoderdov' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'margin_value',
			[
				'label' => __( 'Marin?', 'ihcoderdov' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ihcoderdov' ),
				'label_off' => __( 'Hide', 'ihcoderdov' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'margin_right',
			[
				'label' => __( 'Margin Right', 'ihcoderdov' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '40',
				'condition' => [
					'margin_value' => 'yes',
				],
			]
		);
		$this->add_control(
			'arrows',
			[
				'label' => __( 'Show arrows?', 'ihcoderdov' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ihcoderdov' ),
				'label_off' => __( 'Hide', 'ihcoderdov' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'dots',
			[
				'label' => __( 'Show Dots?', 'ihcoderdov' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ihcoderdov' ),
				'label_off' => __( 'Hide', 'ihcoderdov' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Auto Play?', 'ihcoderdov' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ihcoderdov' ),
				'label_off' => __( 'Hide', 'ihcoderdov' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => __( 'Infinite Loop', 'ihcoderdov' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ihcoderdov' ),
				'label_off' => __( 'Hide', 'ihcoderdov' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'mousedrag',
			[
				'label' => __( 'Mousedrag', 'ihcoderdov' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ihcoderdov' ),
				'label_off' => __( 'Hide', 'ihcoderdov' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_responsive_control(
			'items',
			[
				'label' => __( 'Slider Items', 'ihcoderdov' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default'            => 3,
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
			]
		);
		$this->add_control(
			'autoplaytimeout',
			[
				'label' => __( 'Autoplay Timeout', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'default' => '5000',
				'options' => [
					'1000'  => __( '1 Second', 'ihcoderdov' ),
					'2000'  => __( '2 Second', 'ihcoderdov' ),
					'3000'  => __( '3 Second', 'ihcoderdov' ),
					'4000'  => __( '4 Second', 'ihcoderdov' ),
					'5000'  => __( '5 Second', 'ihcoderdov' ),
					'6000'  => __( '6 Second', 'ihcoderdov' ),
					'7000'  => __( '7 Second', 'ihcoderdov' ),
					'8000'  => __( '8 Second', 'ihcoderdov' ),
					'9000'  => __( '9 Second', 'ihcoderdov' ),
					'10000' => __( '10 Second', 'ihcoderdov' ),
					'11000' => __( '11 Second', 'ihcoderdov' ),
					'12000' => __( '12 Second', 'ihcoderdov' ),
					'13000' => __( '13 Second', 'ihcoderdov' ),
					'14000' => __( '14 Second', 'ihcoderdov' ),
					'15000' => __( '15 Second', 'ihcoderdov' ),
				],
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$galleys = $settings['ihcoderdov_gallery'];


		//this code slider option
		$slider_extraSetting = array(
	        'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
	        'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
        	'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
        	'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
        	'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',
        	'mousedrag' => (!empty($settings['mousedrag']) && 'yes' === $settings['mousedrag']) ? true : false,
        	'items' => !empty($settings['items']) ? $settings['items'] : 3,
        	'margin_value' => !empty($settings['margin_value']) ? 40 : 0,
        );
		$jasondecode = wp_json_encode($slider_extraSetting);





		?>
		<div class="ihcoderdov_slider_gallery" data-settings='<?php echo esc_attr($jasondecode)  ?>'>
			<div class="ihcoderdov_galley_slider owl-carousel">
				<?php foreach ($galleys as $galley):  ?>
					<div class="ihcoderdov_signle-galery-items">
						<img src="<?php echo esc_url( $galley['url']); ?>" alt="">
					</div>
				<?php endforeach ?>
			</div>
		</div>

		<?php

	}


}


