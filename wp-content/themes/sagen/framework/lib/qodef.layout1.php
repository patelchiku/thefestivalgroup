<?php

/*
   Interface: iSagenSelectInterfaceLayoutNode
   A interface that implements Layout Node methods
*/
interface iSagenSelectInterfaceLayoutNode {
	public function hasChidren();
	public function getChild( $key);
	public function addChild( $key, $value);
}

/*
   Interface: iSagenSelectInterfaceRender
   A interface that implements Render methods
*/
interface iSagenSelectInterfaceRender {
	public function render( $factory);
}

/*
   Class: SagenSelectClassPanel
   A class that initializes Select Panel
*/
class SagenSelectClassPanel implements iSagenSelectInterfaceLayoutNode, iSagenSelectInterfaceRender {
	public $children;
	public $title;
	public $name;
	public $args = array();
	public $dependency = array();

	function __construct( $title_panel = '', $name = '', $args = array(), $dependency = array() ) {
		$this->children   = array();
		$this->title      = $title_panel;
		$this->name       = $name;
		$this->args       = $args;
		$this->dependency = $dependency;
	}

	public function hasChidren() {
		return ( is_array( $this->children ) && count( $this->children ) > 0 ) ? true : false;
	}

	public function getChild( $key ) {
		return $this->children[ $key ];
	}

	public function addChild( $key, $value ) {
		$this->children[ $key ] = $value;
	}

	public function render( $factory ) {
		$containerClass = '';
		$data           = array();

		if ( ! empty( $this->dependency ) ) {
			$show           = array_key_exists( 'show', $this->dependency ) ? sagen_select_return_dependency_options_array( $this->dependency['show'], false ) : array();
			$hide           = array_key_exists( 'hide', $this->dependency ) ? sagen_select_return_dependency_options_array( $this->dependency['hide'], true ) : array();
			$showDataValues = '';
			$hideDataValues = '';
			$hideContainer  = true;

			$containerClass = 'qodef-dependency-holder';

			if ( ! empty( $show ) ) {
				$showDataValues = $show['data_values'];
				$hideContainer  = $show['hide_container'];
			}

			if ( ! empty( $hide ) ) {
				$hideDataValues = $hide['data_values'];
				$hideContainer  = $hide['hide_container'];
			}

			$data['data-show'] = ! empty( $showDataValues ) ? json_encode( $showDataValues ) : '';
			$data['data-hide'] = ! empty( $hideDataValues ) ? json_encode( $hideDataValues ) : '';

			if ( $hideContainer ) {
				$containerClass .= ' qodef-hide-dependency-holder';
			}
		}
		?>
		<div class="qodef-page-form-section-holder <?php echo esc_attr( $containerClass ); ?>" id="qodef_<?php echo esc_attr( $this->name ); ?>" <?php echo sagen_select_get_inline_attrs( $data, true ); ?>>
			<h3 class="qodef-page-section-title"><?php echo esc_html( $this->title ); ?></h3>
			<?php
			foreach ( $this->children as $child ) {
				$this->renderChild( $child, $factory );
			}
			?>
		</div>
		<?php
	}

	public function renderChild( iSagenSelectInterfaceRender $child, $factory ) {
		$child->render( $factory );
	}
}

/*
   Class: SagenSelectClassContainer
   A class that initializes Select Container
*/
class SagenSelectClassContainer implements iSagenSelectInterfaceLayoutNode, iSagenSelectInterfaceRender {
	public $children;
	public $name;
	public $dependency;

	function __construct( $name = '', $dependency = array() ) {
		$this->children   = array();
		$this->name       = $name;
		$this->dependency = $dependency;
	}

	public function hasChidren() {
		return ( is_array( $this->children ) && count( $this->children ) > 0 ) ? true : false;
	}

	public function getChild( $key ) {
		return $this->children[ $key ];
	}

	public function addChild( $key, $value ) {
		$this->children[ $key ] = $value;
	}

	public function render( $factory ) {
		$containerClass = '';
		$data           = array();

		if ( ! empty( $this->dependency ) ) {
			$show           = array_key_exists( 'show', $this->dependency ) ? sagen_select_return_dependency_options_array( $this->dependency['show'], false ) : array();
			$hide           = array_key_exists( 'hide', $this->dependency ) ? sagen_select_return_dependency_options_array( $this->dependency['hide'], true ) : array();
			$showDataValues = '';
			$hideDataValues = '';
			$hideContainer  = true;

			$containerClass = 'qodef-dependency-holder';

			if ( ! empty( $show ) ) {
				$showDataValues = $show['data_values'];
				$hideContainer  = $show['hide_container'];
			}

			if ( ! empty( $hide ) ) {
				$hideDataValues = $hide['data_values'];
				$hideContainer  = $hide['hide_container'];
			}

			$data['data-show'] = ! empty( $showDataValues ) ? json_encode( $showDataValues ) : '';
			$data['data-hide'] = ! empty( $hideDataValues ) ? json_encode( $hideDataValues ) : '';

			if ( $hideContainer ) {
				$containerClass .= ' qodef-hide-dependency-holder';
			}
		}
		?>
		<div class="qodef-page-form-container-holder <?php echo esc_attr( $containerClass ); ?>" id="qodef_<?php echo esc_attr( $this->name ); ?>" <?php echo sagen_select_get_inline_attrs( $data, true ); ?>>
			<?php
			foreach ( $this->children as $child ) {
				$this->renderChild( $child, $factory );
			}
			?>
		</div>
		<?php
	}

	public function renderChild( iSagenSelectInterfaceRender $child, $factory ) {
		$child->render( $factory );
	}
}

/*
   Class: SagenSelectClassContainerNoStyle
   A class that initializes Select Container without css classes
*/
class SagenSelectClassContainerNoStyle implements iSagenSelectInterfaceLayoutNode, iSagenSelectInterfaceRender {
	public $children;
	public $name;
	public $dependency;
	public $args;

	function __construct( $name = '', $args = array(), $dependency = array() ) {
		$this->children   = array();
		$this->name       = $name;
		$this->dependency = $dependency;
		$this->args       = $args;
	}

	public function hasChidren() {
		return ( is_array( $this->children ) && count( $this->children ) > 0 ) ? true : false;
	}

	public function getChild( $key ) {
		return $this->children[ $key ];
	}

	public function addChild( $key, $value ) {
		$this->children[ $key ] = $value;
	}

	public function render( $factory ) {
		$containerClass = '';
		$data           = array();

		if ( ! empty( $this->dependency ) ) {
			$show           = array_key_exists( 'show', $this->dependency ) ? sagen_select_return_dependency_options_array( $this->dependency['show'], false ) : array();
			$hide           = array_key_exists( 'hide', $this->dependency ) ? sagen_select_return_dependency_options_array( $this->dependency['hide'], true ) : array();
			$showDataValues = '';
			$hideDataValues = '';
			$hideContainer  = true;

			$containerClass = 'qodef-dependency-holder';

			if ( ! empty( $show ) ) {
				$showDataValues = $show['data_values'];
				$hideContainer  = $show['hide_container'];
			}

			if ( ! empty( $hide ) ) {
				$hideDataValues = $hide['data_values'];
				$hideContainer  = $hide['hide_container'];
			}

			$data['data-show'] = ! empty( $showDataValues ) ? json_encode( $showDataValues ) : '';
			$data['data-hide'] = ! empty( $hideDataValues ) ? json_encode( $hideDataValues ) : '';

			if ( $hideContainer ) {
				$containerClass .= ' qodef-hide-dependency-holder';
			}
		}
		?>
		<div class="<?php echo esc_attr( $containerClass ); ?>" id="qodef_<?php echo esc_attr( $this->name ); ?>" <?php echo sagen_select_get_inline_attrs( $data, true ); ?>>
			<?php
			foreach ( $this->children as $child ) {
				$this->renderChild( $child, $factory );
			}
			?>
		</div>
		<?php
	}

	public function renderChild( iSagenSelectInterfaceRender $child, $factory ) {
		$child->render( $factory );
	}
}

/*
   Class: SagenSelectClassGroup
   A class that initializes Select Group
*/
class SagenSelectClassGroup implements iSagenSelectInterfaceLayoutNode, iSagenSelectInterfaceRender {
	public $children;
	public $title;
	public $description;

	function __construct( $title_group = '', $description = '' ) {
		$this->children    = array();
		$this->title       = $title_group;
		$this->description = $description;
	}

	public function hasChidren() {
		return ( is_array( $this->children ) && count( $this->children ) > 0 ) ? true : false;
	}

	public function getChild( $key ) {
		return $this->children[ $key ];
	}

	public function addChild( $key, $value ) {
		$this->children[ $key ] = $value;
	}

	public function render( $factory ) {
		?>
		<div class="qodef-page-form-section">
			<div class="qodef-field-desc">
				<h4><?php echo esc_html( $this->title ); ?></h4>
				<p><?php echo esc_html( $this->description ); ?></p>
			</div>
			<div class="qodef-section-content">
				<div class="container-fluid">
					<?php
					foreach ( $this->children as $child ) {
						$this->renderChild( $child, $factory );
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}

	public function renderChild( iSagenSelectInterfaceRender $child, $factory ) {
		$child->render( $factory );
	}
}

/*
   Class: SagenSelectClassNotice
   A class that initializes Select Notice
*/
class SagenSelectClassNotice implements iSagenSelectInterfaceRender {
	public $children;
	public $title;
	public $description;
	public $notice;

	function __construct( $title_notice = '', $description = '', $notice = '' ) {
		$this->children    = array();
		$this->title       = $title_notice;
		$this->description = $description;
		$this->notice      = $notice;
	}

	public function render( $factory ) {
		?>
		<div class="qodef-page-form-section">
			<div class="qodef-field-desc">
				<h4><?php echo esc_html( $this->title ); ?></h4>
				<p><?php echo esc_html( $this->description ); ?></p>
			</div>
			<div class="qodef-section-content">
				<div class="container-fluid">
					<div class="alert alert-warning">
						<?php echo esc_html( $this->notice ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

/*
   Class: SagenSelectClassRow
   A class that initializes Select Row
*/
class SagenSelectClassRow implements iSagenSelectInterfaceLayoutNode, iSagenSelectInterfaceRender {
	public $children;
	public $next;

	function __construct( $next = false ) {
		$this->children = array();
		$this->next     = $next;
	}

	public function hasChidren() {
		return ( is_array( $this->children ) && count( $this->children ) > 0 ) ? true : false;
	}

	public function getChild( $key ) {
		return $this->children[ $key ];
	}

	public function addChild( $key, $value ) {
		$this->children[ $key ] = $value;
	}

	public function render( $factory ) {
		?>
		<div class="row
		<?php
		if ( $this->next ) {
			echo ' next-row'; }
		?>
		">
			<?php
			foreach ( $this->children as $child ) {
				$this->renderChild( $child, $factory );
			}
			?>
		</div>
		<?php
	}

	public function renderChild( iSagenSelectInterfaceRender $child, $factory ) {
		$child->render( $factory );
	}
}

/*
   Class: SagenSelectClassTitle
   A class that initializes Select Title
*/
class SagenSelectClassTitle implements iSagenSelectInterfaceRender {
	private $name;
	private $title;

	function __construct( $name = '', $title_class = '' ) {
		$this->title = $title_class;
		$this->name  = $name;
	}

	public function render( $factory ) {
		?>
		<h5 class="qodef-page-section-subtitle" id="qodef_<?php echo esc_attr( $this->name ); ?>"><?php echo esc_html( $this->title ); ?></h5>
		<?php
	}
}

/*
   Class: SagenSelectClassField
   A class that initializes Select Field
*/
class SagenSelectClassField implements iSagenSelectInterfaceRender {
	private $type;
	private $name;
	private $default_value;
	private $label;
	private $description;
	private $options   = array();
	private $args      = array();
	public $dependency = array();

	function __construct( $type, $name, $default_value = '', $label = '', $description = '', $options = array(), $args = array(), $dependency = array() ) {
		global $sagen_select_global_Framework;
		$this->type          = $type;
		$this->name          = $name;
		$this->default_value = $default_value;
		$this->label         = $label;
		$this->description   = $description;
		$this->options       = $options;
		$this->args          = $args;
		$this->dependency    = $dependency;
		$sagen_select_global_Framework->qodeOptions->addOption( $this->name, $this->default_value, $type );
	}

	public function render( $factory ) {
		$containerClass = '';
		$data           = array();

		if ( ! empty( $this->dependency ) ) {
			$show           = array_key_exists( 'show', $this->dependency ) ? sagen_select_return_dependency_options_array( $this->dependency['show'], false ) : array();
			$hide           = array_key_exists( 'hide', $this->dependency ) ? sagen_select_return_dependency_options_array( $this->dependency['hide'], true ) : array();
			$showDataValues = '';
			$hideDataValues = '';
			$hideContainer  = true;

			$containerClass = 'qodef-dependency-holder';

			if ( ! empty( $show ) ) {
				$showDataValues = $show['data_values'];
				$hideContainer  = $show['hide_container'];
			}

			if ( ! empty( $hide ) ) {
				$hideDataValues = $hide['data_values'];
				$hideContainer  = $hide['hide_container'];
			}

			$data['data-show'] = ! empty( $showDataValues ) ? json_encode( $showDataValues ) : '';
			$data['data-hide'] = ! empty( $hideDataValues ) ? json_encode( $hideDataValues ) : '';

			if ( $hideContainer ) {
				$containerClass .= ' qodef-hide-dependency-holder';
			}
		}
		?>
		<div class="<?php echo esc_attr( $containerClass ); ?>" <?php echo sagen_select_get_inline_attrs( $data, true ); ?>>
			<?php
			$factory->render( $this->type, $this->name, $this->label, $this->description, $this->options, $this->args );
			?>
		</div>
		<?php
	}
}

/*
   Class: SagenSelectClassMetaField
   A class that initializes Select Meta Field
*/
class SagenSelectClassMetaField implements iSagenSelectInterfaceRender {
	private $type;
	private $name;
	private $default_value;
	private $label;
	private $description;
	private $options   = array();
	private $args      = array();
	public $dependency = array();

	function __construct( $type, $name, $default_value = '', $label = '', $description = '', $options = array(), $args = array(), $dependency = array() ) {
		global $sagen_select_global_Framework;
		$this->type          = $type;
		$this->name          = $name;
		$this->default_value = $default_value;
		$this->label         = $label;
		$this->description   = $description;
		$this->options       = $options;
		$this->args          = $args;
		$this->dependency    = $dependency;
		$sagen_select_global_Framework->qodeMetaBoxes->addOption( $this->name, $this->default_value, $type );
	}

	public function render( $factory ) {
		$containerClass = '';
		$data           = array();

		if ( ! empty( $this->dependency ) ) {
			$show           = array_key_exists( 'show', $this->dependency ) ? sagen_select_return_dependency_options_array( $this->dependency['show'], false ) : array();
			$hide           = array_key_exists( 'hide', $this->dependency ) ? sagen_select_return_dependency_options_array( $this->dependency['hide'], true ) : array();
			$showDataValues = '';
			$hideDataValues = '';
			$hideContainer  = true;

			$containerClass = 'qodef-dependency-holder';

			if ( ! empty( $show ) ) {
				$showDataValues = $show['data_values'];
				$hideContainer  = $show['hide_container'];
			}

			if ( ! empty( $hide ) ) {
				$hideDataValues = $hide['data_values'];
				$hideContainer  = $hide['hide_container'];
			}

			$data['data-show'] = ! empty( $showDataValues ) ? json_encode( $showDataValues ) : '';
			$data['data-hide'] = ! empty( $hideDataValues ) ? json_encode( $hideDataValues ) : '';

			if ( $hideContainer ) {
				$containerClass .= ' qodef-hide-dependency-holder';
			}
		}
		?>
		<div class="<?php echo esc_attr( $containerClass ); ?>" <?php echo sagen_select_get_inline_attrs( $data, true ); ?>>
			<?php
			$factory->render( $this->type, $this->name, $this->label, $this->description, $this->options, $this->args );
			?>
		</div>
		<?php
	}
}

abstract class SagenSelectClassFieldType {
	abstract public function render( $name, $label = '', $description = '', $options = array(), $args = array() );
}

class SagenSelectClassFieldText extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array(), $repeat = array() ) {
		$col_width = 12;
		if ( isset( $args['col_width'] ) ) {
			$col_width = $args['col_width'];
		}

		$suffix = ! empty( $args['suffix'] ) ? $args['suffix'] : false;

		$class = '';
		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id    = $name . '-' . $repeat['index'];
			$name  = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$value = $repeat['value'];
		} else {
			$id    = $name;
			$value = sagen_select_option_get_value( $name );
		}

		if ( $label === '' && $description === '' ) {
			$class .= ' qodef-no-description';
		}

		if ( isset( $args['custom_class'] ) && $args['custom_class'] != '' ) {
			$class .= ' ' . $args['custom_class'];
		}

		$data_string = '';
		if ( isset( $args['input-data'] ) && $args['input-data'] != '' ) {
			foreach ( $args['input-data'] as $data_key => $data_value ) {
				$data_string .= $data_key . '=' . $data_value;
				$data_string .= ' ';
			}
		}
		?>
		<div class="qodef-page-form-section <?php echo esc_attr( $class ); ?>" id="qodef_<?php echo esc_attr( $id ); ?>">
			<div class="qodef-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="qodef-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-<?php echo esc_attr( $col_width ); ?>">
							<?php if ( $suffix ) : ?>
								<div class="input-group">
							<?php endif; ?>
								<input type="text" <?php echo esc_attr( $data_string ); ?> class="form-control qodef-input qodef-form-element" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( htmlspecialchars( $value ) ); ?>"/>
								<?php if ( $suffix ) : ?>
									<div class="input-group-addon"><?php echo esc_html( $args['suffix'] ); ?></div>
								<?php endif; ?>
							<?php if ( $suffix ) : ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class SagenSelectClassFieldTextSimple extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array() ) {
		$col_width = 3;
		if ( isset( $args['col_width'] ) ) {
			$col_width = $args['col_width'];
		}
		$suffix = ! empty( $args['suffix'] ) ? $args['suffix'] : false;
		?>
		
		<div class="col-lg-<?php echo esc_attr( $col_width ); ?>" id="qodef_<?php echo esc_attr( $name ); ?>">
			<em class="qodef-field-description"><?php echo esc_html( $label ); ?></em>
			<?php if ( $suffix ) : ?>
				<div class="input-group">
			<?php endif; ?>
				<input type="text" class="form-control qodef-input qodef-form-element" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( htmlspecialchars( sagen_select_option_get_value( $name ) ) ); ?>"/>
				<?php if ( $suffix ) : ?>
					<div class="input-group-addon"><?php echo esc_html( $args['suffix'] ); ?></div>
				<?php endif; ?>
			<?php if ( $suffix ) : ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}

class SagenSelectClassFieldTextArea extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array(), $repeat = array() ) {
		$class = '';

		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id    = $name . '-' . $repeat['index'];
			$name  = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$value = $repeat['value'];
		} else {
			$id    = $name;
			$value = sagen_select_option_get_value( $name );
		}

		if ( $label === '' && $description === '' ) {
			$class .= ' qodef-no-description';
		}

		$disabled = '';
		if ( isset( $args['disabled'] ) && $args['disabled'] ) {
			$disabled = ' disabled';
		}
		?>
		<div class="qodef-page-form-section <?php echo esc_attr( $class ); ?>" id="qodef_<?php echo esc_attr( $id ); ?>">
			<div class="qodef-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="qodef-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<textarea class="form-control qodef-form-element" name="<?php echo esc_attr( $name ); ?>" rows="5" <?php echo esc_attr( $disabled ); ?>><?php echo esc_html( htmlspecialchars( $value ) ); ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class SagenSelectClassFieldTextAreaSimple extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array() ) {
		?>
		<div class="col-lg-3">
			<em class="qodef-field-description"><?php echo esc_html( $label ); ?></em>
			<textarea class="form-control qodef-form-element" name="<?php echo esc_attr( $name ); ?>" rows="5"><?php echo esc_html( sagen_select_option_get_value( $name ) ); ?></textarea>
		</div>
		<?php
	}
}

class SagenSelectClassFieldTextAreaHtml extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array(), $repeat = array() ) {
		$class = '';

		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id = $name . '-' . $repeat['index'];

			//if textareahtml already exists it will have index as number, if created in repeater it will be a string because of the tinymce rules
			if ( is_int( $repeat['index'] ) ) {
				$field_id = $repeat['name'] . '_textarea_index_' . $repeat['index'] . '_' . $name;
			} else {
				$field_id = $repeat['name'] . '_textarea_index_' . $name;
			}
			$name  = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$value = $repeat['value'];
		} else {
			$id    = $field_id = $name;
			$value = sagen_select_option_get_value( $name );
		}
		if ( $label === '' && $description === '' ) {
			$class .= ' qodef-no-description';
		}
		?>
		<div class="qodef-page-form-section <?php echo esc_attr( $class ); ?>" id="qodef_<?php echo esc_attr( $id ); ?>">
			<div class="qodef-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="qodef-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 <?php echo esc_attr( $class ); ?>">
							<?php
							wp_editor(
								$value,
								$field_id,
								array(
									'textarea_name' => $name,
									'height'        => '200',
								)
							);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class SagenSelectClassFieldColor extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array(), $repeat = array() ) {

		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id    = $name . '-' . $repeat['index'];
			$name  = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$value = $repeat['value'];
		} else {
			$id    = $name;
			$value = sagen_select_option_get_value( $name );
		}
		?>
		<div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $id ); ?>">
			<div class="qodef-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="qodef-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<input type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" class="my-color-field"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class SagenSelectClassFieldColorSimple extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array() ) {
		?>
		<div class="col-lg-3" id="qodef_<?php echo esc_attr( $name ); ?>">
			<em class="qodef-field-description"><?php echo esc_html( $label ); ?></em>
			<input type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( sagen_select_option_get_value( $name ) ); ?>" class="my-color-field"/>
		</div>
		<?php
	}
}

class SagenSelectClassFieldImage extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array(), $repeat = array() ) {

		$class = '';
		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id        = $name . '-' . $repeat['index'];
			$name      = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$value     = $repeat['value'];
			$has_image = ! empty( $value );
		} else {
			$id        = $name;
			$has_image = sagen_select_option_has_value( $name );
			$value     = sagen_select_option_get_value( $name );
		}

		if ( $label === '' && $description === '' ) {
			$class .= ' qodef-no-description';
		}
		?>
		<div class="qodef-page-form-section <?php echo esc_attr( $class ); ?>" id="qodef_<?php echo esc_attr( $id ); ?>">
			<div class="qodef-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="qodef-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="qodef-media-uploader">
								<div class="qodef-media-image-holder <?php echo ! $has_image ? 'qodef-hide-field' : ''; ?>">
									<img src="
									<?php
									if ( $has_image ) {
										echo esc_url( sagen_select_get_attachment_thumb_url( $value ) ); }
									?>
									" alt="<?php esc_attr_e( 'Image thumbnail', 'sagen' ); ?>" class="qodef-media-image img-thumbnail"/>
								</div>
								<div class="qodef-media-meta-fields qodef-hide-field">
									<input type="hidden" class="qodef-media-upload-url" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>"/>
								</div>
								<a class="qodef-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'sagen' ); ?>" data-frame-button-text="<?php esc_attr_e( 'Select Image', 'sagen' ); ?>"><?php esc_html_e( 'Upload', 'sagen' ); ?></a>
								<a href="javascript: void(0)" class="qodef-media-remove-btn btn btn-default btn-sm qodef-hide-field"><?php esc_html_e( 'Remove', 'sagen' ); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class SagenSelectClassFieldImageSimple extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array() ) {
		?>
		<div class="col-lg-3" id="qodef_<?php echo esc_attr( $name ); ?>">
			<em class="qodef-field-description"><?php echo esc_html( $label ); ?></em>
			<div class="qodef-media-uploader">
				<div class="qodef-media-image-holder <?php echo ! sagen_select_option_has_value( $name ) ? 'qodef-hide-field' : ''; ?>">
					<img src="
					<?php
					if ( sagen_select_option_has_value( $name ) ) {
						echo esc_url( sagen_select_get_attachment_thumb_url( sagen_select_option_get_value( $name ) ) ); }
					?>
					" alt="<?php esc_attr_e( 'Image thumbnail', 'sagen' ); ?>" class="qodef-media-image img-thumbnail"/>
				</div>
				<div class="qodef-media-meta-fields qodef-hide-field">
					<input type="hidden" class="qodef-media-upload-url" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( sagen_select_option_get_value( $name ) ); ?>"/>
				</div>
				<a class="qodef-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'sagen' ); ?>" data-frame-button-text="<?php esc_attr_e( 'Select Image', 'sagen' ); ?>"><?php esc_html_e( 'Upload', 'sagen' ); ?></a>
				<a href="javascript: void(0)" class="qodef-media-remove-btn btn btn-default btn-sm qodef-hide-field"><?php esc_html_e( 'Remove', 'sagen' ); ?></a>
			</div>
		</div>
		<?php
	}
}

class SagenSelectClassFieldFont extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array(), $repeat = array() ) {
		global $sagen_select_global_fonts_array;

		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id    = $name . '-' . $repeat['index'];
			$name  = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$value = $repeat['value'];
		} else {
			$id    = $name;
			$value = sagen_select_option_get_value( $name );
		}
		?>
		<div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $id ); ?>">
			<div class="qodef-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="qodef-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3">
							<select class="qodef-select2 form-control qodef-form-element" name="<?php echo esc_attr( $name ); ?>">
								<option value="-1"><?php esc_html_e( 'Default', 'sagen' ); ?></option>
								<?php foreach ( $sagen_select_global_fonts_array as $fontArray ) { ?>
									<option 
									<?php
									if ( $value == str_replace( ' ', '+', $fontArray['family'] ) ) {
										echo "selected='selected'"; }
									?>
									 value="<?php echo esc_attr( str_replace( ' ', '+', $fontArray['family'] ) ); ?>"><?php echo esc_html( $fontArray['family'] ); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class SagenSelectClassFieldFontSimple extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array() ) {
		global $sagen_select_global_fonts_array;
		?>
		<div class="col-lg-3">
			<em class="qodef-field-description"><?php echo esc_html( $label ); ?></em>
			<select class="qodef-select2 form-control qodef-form-element" name="<?php echo esc_attr( $name ); ?>">
				<option value="-1"><?php esc_html_e( 'Default', 'sagen' ); ?></option>
				<?php foreach ( $sagen_select_global_fonts_array as $fontArray ) { ?>
					<option 
					<?php
					if ( sagen_select_option_get_value( $name ) == str_replace( ' ', '+', $fontArray['family'] ) ) {
						echo "selected='selected'"; }
					?>
					 value="<?php echo esc_attr( str_replace( ' ', '+', $fontArray['family'] ) ); ?>"><?php echo esc_html( $fontArray['family'] ); ?></option>
				<?php } ?>
			</select>
		</div>
		<?php
	}
}

class SagenSelectClassFieldSelect extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array(), $repeat = array() ) {
		$class = '';

		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id     = $name . '-' . $repeat['index'];
			$name   = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$rvalue = $repeat['value'];
			$class  = 'qodef-repeater-field';
		} else {
			$id     = $name;
			$rvalue = sagen_select_option_get_value( $name );
		}

		$select2 = '';
		if ( isset( $args['select2'] ) ) {
			$select2 = 'qodef-select2';
		}
		$col_width = 3;
		if ( isset( $args['col_width'] ) ) {
			$col_width = $args['col_width'];
		}

		$switcher             = '';
		$data_switch_type     = '';
		$data_switch_property = '';
		$data_switch_enabled  = '';
		if ( isset( $args['use_as_switcher'] ) ) {
			$switcher = $args['use_as_switcher'] ? 'qodef-switcher' : '';
		}
		if ( isset( $args['switch_type'] ) ) {
			$data_switch_type = $args['switch_type'];
		}
		if ( isset( $args['switch_property'] ) ) {
			$data_switch_property = $args['switch_property'];
		}
		if ( isset( $args['switch_enabled'] ) ) {
			$data_switch_enabled = $args['switch_enabled'];
		}

		if ( $label === '' && $description === '' ) {
			$class .= ' qodef-no-description';
		}
		?>
		<div class="qodef-page-form-section <?php echo esc_attr( $class ); ?>" id="qodef_<?php echo esc_attr( $id ); ?>">
			<div class="qodef-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="qodef-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-<?php echo esc_attr( $col_width ); ?>">
							<select class="<?php echo esc_attr( $select2 ) . ' ' . esc_attr( $switcher ); ?> qodef-field form-control qodef-form-element" data-switch-type="<?php echo esc_attr( $data_switch_type ); ?>" data-switch-property="<?php echo esc_attr( $data_switch_property ); ?>" data-switch-enabled="<?php echo esc_attr( $data_switch_enabled ); ?>" name="<?php echo esc_attr( $name ); ?>" data-option-name="<?php echo esc_attr( $name ); ?>" data-option-type="selectbox">
								<?php
								foreach ( $options as $key => $value ) {
									if ( $key == '-1' ) {
										$key = '';
									}
									?>
									<option 
									<?php
									if ( $rvalue == $key ) {
										echo "selected='selected'"; }
									?>
									 value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class SagenSelectClassFieldSelectBlank extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array() ) {
		$class = '';

		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id     = $name . '-' . $repeat['index'];
			$name   = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$rvalue = $repeat['value'];
			$class  = 'qodef-repeater-field';
		} else {
			$id     = $name;
			$rvalue = sagen_select_option_get_value( $name );
		}

		$select2 = '';
		if ( isset( $args['select2'] ) ) {
			$select2 = ( $args['select2'] ) ? 'qodef-select2' : '';
		}
		?>
		<div class="qodef-page-form-section <?php echo esc_attr( $class ); ?>" id="qodef_<?php echo esc_attr( $id ); ?>">
			<div class="qodef-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="qodef-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3">
							<select class="<?php echo esc_attr( $select2 ); ?> qodef-field form-control qodef-form-element" name="<?php echo esc_attr( $name ); ?>" data-option-name="<?php echo esc_attr( $name ); ?>" data-option-type="selectbox">
								<option value="" 
								<?php
								if ( sagen_select_option_get_value( $name ) == '' ) {
									echo "selected='selected'"; }
								?>
								><?php esc_html_e( 'Default', 'sagen' ); ?></option>
								<?php
								foreach ( $options as $key => $value ) {
									if ( $key == '-1' ) {
										$key = '';
									}
									?>
									<option 
									<?php
									if ( $rvalue == $key ) {
										echo "selected='selected'"; }
									?>
									 value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class SagenSelectClassFieldSelectSimple extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array() ) {
		?>
		<div class="col-lg-3">
			<em class="qodef-field-description"><?php echo esc_html( $label ); ?></em>
			<select class="qodef-field form-control qodef-form-element" name="<?php echo esc_attr( $name ); ?>" data-option-name="<?php echo esc_attr( $name ); ?>" data-option-type="selectbox">
				<option 
				<?php
				if ( sagen_select_option_get_value( $name ) == '' ) {
					echo "selected='selected'"; }
				?>
				 value=""></option>
				<?php
				foreach ( $options as $key => $value ) {
					if ( $key == '-1' ) {
						$key = '';
					}
					?>
					<option 
					<?php
					if ( sagen_select_option_get_value( $name ) == $key ) {
						echo "selected='selected'"; }
					?>
					 value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
				<?php } ?>
			</select>
		</div>
		<?php
	}
}

class SagenSelectClassFieldSelectBlankSimple extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array() ) {
		?>
		<div class="col-lg-3">
			<em class="qodef-field-description"><?php echo esc_html( $label ); ?></em>
			<select class="qodef-field form-control qodef-form-element" name="<?php echo esc_attr( $name ); ?>" data-option-name="<?php echo esc_attr( $name ); ?>" data-option-type="selectbox">
				<option 
				<?php
				if ( sagen_select_option_get_value( $name ) == '' ) {
					echo "selected='selected'"; }
				?>
				 value=""></option>
				<?php
				foreach ( $options as $key => $value ) {
					if ( $key == '-1' ) {
						$key = '';
					}
					?>
					<option 
					<?php
					if ( sagen_select_option_get_value( $name ) == $key ) {
						echo "selected='selected'"; }
					?>
					 value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
				<?php } ?>
			</select>
		</div>
		<?php
	}
}

class SagenSelectClassFieldYesNo extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array(), $repeat = array() ) {
		$switcher_name = $name;

		$class = '';
		$tname = $name;
		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id     = $name . '-' . $repeat['index'];
			$tname  = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$name   = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$rvalue = $repeat['value'];
			$class  = 'qodef-repeater-field';
		} else {
			$id     = $name;
			$rvalue = sagen_select_option_get_value( $name );
		}

		if ( $label === '' && $description === '' ) {
			$class .= ' qodef-no-description';
		}
		?>
		<div class="qodef-page-form-section <?php echo esc_attr( $class ); ?>" id="qodef_<?php echo esc_attr( $id ); ?>">
			<div class="qodef-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="qodef-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="qodef-field field switch switch-<?php echo esc_attr( $switcher_name ); ?>" data-option-name="<?php echo esc_attr( $tname ); ?>" data-option-type="checkbox">
								<label class="cb-enable 
								<?php
								if ( $rvalue == 'yes' ) {
									echo ' selected'; }
								?>
								" data-value="yes"><span><?php esc_html_e( 'Yes', 'sagen' ); ?></span></label>
								<label class="cb-disable 
								<?php
								if ( $rvalue == 'no' ) {
									echo ' selected'; }
								?>
								" data-value="no"><span><?php esc_html_e( 'No', 'sagen' ); ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox" name="<?php echo esc_attr( $tname ); ?>" value="yes"
																									   <?php
																										if ( $rvalue == 'yes' ) {
																											echo ' checked'; }
																										?>
								/>
								<input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $rvalue ); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class SagenSelectClassFieldYesNoSimple extends SagenSelectClassFieldType {
	public function render( $name, $label = '', $description = '', $options = array(), $args = array() ) {
		?>
		<div class="col-lg-3">
			<em class="qodef-field-description"><?php echo esc_html( $label ); ?></em>
			<p class="qodef-field field switch" data-option-name="<?php echo esc_attr( $name ); ?>" data-option-type="checkbox">
				<label class="cb-enable
				<?php
				if ( sagen_select_option_get_value( $name ) == 'yes' ) {
					echo ' selected'; }
				?>
				" data-value="yes"><span><?php esc_html_e( 'Yes', 'sagen' ); ?></span></label>
				<label class="cb-disable
				<?php
				if ( sagen_select_option_get_value( $name ) == 'no' ) {
					echo ' selected'; }
				?>
				" data-value="no"><span><?php esc_html_e( 'No', 'sagen' ); ?></span></label>
				<input type="checkbox" id="checkbox" class="checkbox" name="<?php echo esc_attr( $name ); ?>_yesno" value="yes"
																					   <?php
																						if ( sagen_select_option_get_value( $name ) == 'yes' ) {
																							echo ' selected'; }
																						?>
				/>
				<input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( sagen_select_option_get_value( $name ) ); ?>"/>
			</p>
		</div>
		<?php
	}
}
