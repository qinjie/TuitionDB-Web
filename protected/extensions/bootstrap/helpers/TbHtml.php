<?php
/**
 * TbHtml class file.
 * @author Antonio Ramirez <ramirez.cobos@gmail.com>
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.helpers
 */

/**
 * Bootstrap HTML helper.
 */
class TbHtml extends CHtml // required in order to access the protected methods in CHtml
{
    //
    // TYPOGRAPHY
    // --------------------------------------------------

    const TEXT_ALIGN_LEFT = 'left';
    const TEXT_ALIGN_CENTER = 'center';
    const TEXT_ALIGN_RIGHT = 'right';

    const TEXT_COLOR_DEFAULT = '';
    const TEXT_COLOR_WARNING = 'warning';
    const TEXT_COLOR_ERROR = 'error';
    const TEXT_COLOR_INFO = 'info';
    const TEXT_COLOR_SUCCESS = 'success';

    const HELP_TYPE_INLINE = 'inline';
    const HELP_TYPE_BLOCK = 'block';

    //
    // FORM
    // --------------------------------------------------

    const FORM_LAYOUT_VERTICAL = 'vertical';
    const FORM_LAYOUT_HORIZONTAL = 'horizontal';
    const FORM_LAYOUT_INLINE = 'inline';
    const FORM_LAYOUT_SEARCH = 'search';

    const INPUT_TYPE_TEXT = 'textField';
    const INPUT_TYPE_PASSWORD = 'passwordField';
    const INPUT_TYPE_URL = 'urlField';
    const INPUT_TYPE_EMAIL = 'emailField';
    const INPUT_TYPE_NUMBER = 'numberField';
    const INPUT_TYPE_RANGE = 'rangeField';
    const INPUT_TYPE_DATE = 'dateField';
    const INPUT_TYPE_TEXTAREA = 'textArea';
    const INPUT_TYPE_FILE = 'fileField';
    const INPUT_TYPE_RADIOBUTTON = 'radioButton';
    const INPUT_TYPE_CHECKBOX = 'checkBox';
    const INPUT_TYPE_DROPDOWNLIST = 'dropDownList';
    const INPUT_TYPE_LISTBOX = 'listBox';
    const INPUT_TYPE_CHECKBOXLIST = 'checkBoxList';
    const INPUT_TYPE_INLINECHECKBOXLIST = 'inlineCheckBoxList';
    const INPUT_TYPE_RADIOBUTTONLIST = 'radioButtonList';
    const INPUT_TYPE_INLINERADIOBUTTONLIST = 'inlineRadioButtonList';
    const INPUT_TYPE_UNEDITABLE = 'uneditableField';
    const INPUT_TYPE_SEARCH = 'searchQuery';
    const INPUT_TYPE_CUSTOM = 'widget';

    const INPUT_SIZE_MINI = 'mini';
    const INPUT_SIZE_SMALL = 'small';
    const INPUT_SIZE_DEFAULT = '';
    const INPUT_SIZE_MEDIUM = 'medium';
    const INPUT_SIZE_LARGE = 'large';
    const INPUT_SIZE_XLARGE = 'xlarge';
    const INPUT_SIZE_XXLARGE = 'xxlarge';

    const INPUT_COLOR_DEFAULT = '';
    const INPUT_COLOR_WARNING = 'warning';
    const INPUT_COLOR_ERROR = 'error';
    const INPUT_COLOR_INFO = 'info';
    const INPUT_COLOR_SUCCESS = 'success';

    //
    // BUTTONS
    // --------------------------------------------------

    const BUTTON_TYPE_LINK = 'link';
    const BUTTON_TYPE_HTML = 'htmlButton';
    const BUTTON_TYPE_SUBMIT = 'submitButton';
    const BUTTON_TYPE_RESET = 'resetButton';
    const BUTTON_TYPE_IMAGE = 'imageButton';
    const BUTTON_TYPE_LINKBUTTON = 'linkButton';
    const BUTTON_TYPE_AJAXLINK = 'ajaxLink';
    const BUTTON_TYPE_AJAXBUTTON = 'ajaxButton';
    const BUTTON_TYPE_INPUTBUTTON = 'inputButton';
    const BUTTON_TYPE_INPUTSUBMIT = 'inputSubmit';

    const BUTTON_COLOR_DEFAULT = '';
    const BUTTON_COLOR_PRIMARY = 'primary';
    const BUTTON_COLOR_INFO = 'info';
    const BUTTON_COLOR_SUCCESS = 'success';
    const BUTTON_COLOR_WARNING = 'warning';
    const BUTTON_COLOR_DANGER = 'danger';
    const BUTTON_COLOR_INVERSE = 'inverse';
    const BUTTON_COLOR_LINK = 'link';

    const BUTTON_SIZE_MINI = 'mini';
    const BUTTON_SIZE_SMALL = 'small';
    const BUTTON_SIZE_DEFAULT = '';
    const BUTTON_SIZE_LARGE = 'large';

    const BUTTON_TOGGLE_CHECKBOX = 'checkbox';
    const BUTTON_TOGGLE_RADIO = 'radio';

    //
    // IMAGES
    // --------------------------------------------------

    const IMAGE_TYPE_ROUNDED = 'rounded';
    const IMAGE_TYPE_CIRCLE = 'circle';
    const IMAGE_TYPE_POLAROID = 'polaroid';

    //
    // NAV
    // --------------------------------------------------

    const NAV_TYPE_NONE = '';
    const NAV_TYPE_TABS = 'tabs';
    const NAV_TYPE_PILLS = 'pills';
    const NAV_TYPE_LIST = 'list';

    const TABS_PLACEMENT_ABOVE = '';
    const TABS_PLACEMENT_BELOW = 'below';
    const TABS_PLACEMENT_LEFT = 'left';
    const TABS_PLACEMENT_RIGHT = 'right';

    //
    // NAVBAR
    // --------------------------------------------------

    const NAVBAR_DISPLAY_NONE = '';
    const NAVBAR_DISPLAY_FIXEDTOP = 'fixed-top';
    const NAVBAR_DISPLAY_FIXEDBOTTOM = 'fixed-bottom';
    const NAVBAR_DISPLAY_STATICTOP = 'static-top';

    const NAVBAR_COLOR_INVERSE = 'inverse';

    //
    // PAGINATION
    // --------------------------------------------------

    const PAGINATION_SIZE_MINI = 'mini';
    const PAGINATION_SIZE_SMALL = 'small';
    const PAGINATION_SIZE_DEFAULT = '';
    const PAGINATION_SIZE_LARGE = 'large';

    const PAGINATION_ALIGN_LEFT = 'left';
    const PAGINATION_ALIGN_CENTER = 'centered';
    const PAGINATION_ALIGN_RIGHT = 'right';

    //
    // LABELS AND BADGES
    // --------------------------------------------------

    const LABEL_COLOR_DEFAULT = '';
    const LABEL_COLOR_SUCCESS = 'success';
    const LABEL_COLOR_WARNING = 'warning';
    const LABEL_COLOR_IMPORTANT = 'important';
    const LABEL_COLOR_INFO = 'info';
    const LABEL_COLOR_INVERSE = 'inverse';

    const BADGE_COLOR_DEFAULT = '';
    const BADGE_COLOR_SUCCESS = 'success';
    const BADGE_COLOR_WARNING = 'warning';
    const BADGE_COLOR_IMPORTANT = 'important';
    const BADGE_COLOR_INFO = 'info';
    const BADGE_COLOR_INVERSE = 'inverse';

    //
    // TOOLTIPS AND POPOVERS
    // --------------------------------------------------

    const TOOLTIP_PLACEMENT_TOP = 'top';
    const TOOLTIP_PLACEMENT_BOTTOM = 'bottom';
    const TOOLTIP_PLACEMENT_LEFT = 'left';
    const TOOLTIP_PLACEMENT_RIGHT = 'right';

    const TOOLTIP_TRIGGER_CLICK = 'click';
    const TOOLTIP_TRIGGER_HOVER = 'hover';
    const TOOLTIP_TRIGGER_FOCUS = 'focus';
    const TOOLTIP_TRIGGER_MANUAL = 'manual';

    const POPOVER_PLACEMENT_TOP = 'top';
    const POPOVER_PLACEMENT_BOTTOM = 'bottom';
    const POPOVER_PLACEMENT_LEFT = 'left';
    const POPOVER_PLACEMENT_RIGHT = 'right';

    const POPOVER_TRIGGER_CLICK = 'click';
    const POPOVER_TRIGGER_HOVER = 'hover';
    const POPOVER_TRIGGER_FOCUS = 'focus';
    const POPOVER_TRIGGER_MANUAL = 'manual';

    //
    // ALERT
    // --------------------------------------------------

    const ALERT_COLOR_DEFAULT = '';
    const ALERT_COLOR_INFO = 'info';
    const ALERT_COLOR_SUCCESS = 'success';
    const ALERT_COLOR_WARNING = 'warning';
    const ALERT_COLOR_ERROR = 'error';
    const ALERT_COLOR_DANGER = 'danger';

    //
    // PROGRESS BARS
    // --------------------------------------------------

    const PROGRESS_COLOR_DEFAULT = '';
    const PROGRESS_COLOR_INFO = 'info';
    const PROGRESS_COLOR_SUCCESS = 'success';
    const PROGRESS_COLOR_WARNING = 'warning';
    const PROGRESS_COLOR_DANGER = 'danger';

    //
    // MISC
    // --------------------------------------------------

    const WELL_SIZE_SMALL = 'small';
    const WELL_SIZE_DEFAULT = '';
    const WELL_SIZE_LARGE = 'large';

    const PULL_LEFT = 'left';
    const PULL_RIGHT = 'right';

    const CLOSE_DISMISS_ALERT = 'alert';
    const CLOSE_DISMISS_MODAL = 'modal';

    //
    // DETAIL VIEW
    // --------------------------------------------------

    const DETAIL_TYPE_STRIPED = 'striped';
    const DETAIL_TYPE_BORDERED = 'bordered';
    const DETAIL_TYPE_CONDENSED = 'condensed';
    const DETAIL_TYPE_HOVER = 'hover';

    //
    // GRID VIEW
    // --------------------------------------------------

    const GRID_TYPE_STRIPED = 'striped';
    const GRID_TYPE_BORDERED = 'bordered';
    const GRID_TYPE_CONDENSED = 'condensed';
    const GRID_TYPE_HOVER = 'hover';

    //
    // AFFIX
    // --------------------------------------------------

    const AFFIX_POSITION_TOP = 'top';
    const AFFIX_POSITION_BOTTOM = 'bottom';

    //
    // ICON
    // --------------------------------------------------

    const ICON_COLOR_DEFAULT = '';
    const ICON_COLOR_WHITE = 'white';

    const ICON_GLASS = 'icon-glass';
    const ICON_MUSIC = 'icon-music';
    const ICON_SEARCH = 'icon-search';
    const ICON_ENVELOPE = 'icon-envelope';
    const ICON_HEART = 'icon-heart';
    const ICON_STAR = 'icon-star';
    const ICON_STAR_EMPTY = 'icon-star-empty';
    const ICON_USER = 'icon-user';
    const ICON_FILM = 'icon-film';
    const ICON_TH_LARGE = 'icon-th-large';
    const ICON_TH = 'icon-th';
    const ICON_TH_LIST = 'icon-th-list';
    const ICON_OK = 'icon-ok';
    const ICON_REMOVE = 'icon-remove';
    const ICON_ZOOM_IN = 'icon-zoom-in';
    const ICON_ZOOM_OUT = 'icon-zoom-out';
    const ICON_OFF = 'icon-off';
    const ICON_SIGNAL = 'icon-signal';
    const ICON_COG = 'icon-cog';
    const ICON_TRASH = 'icon-trash';
    const ICON_HOME = 'icon-home';
    const ICON_FILE = 'icon-file';
    const ICON_TIME = 'icon-time';
    const ICON_ROAD = 'icon-road';
    const ICON_DOWNLOAD_ALT = 'icon-download-alt';
    const ICON_DOWNLOAD = 'icon-download';
    const ICON_UPLOAD = 'icon-upload';
    const ICON_INBOX = 'icon-inbox';
    const ICON_PLAY_CIRCLE = 'icon-play-circle';
    const ICON_REPEAT = 'icon-repeat';
    const ICON_REFRESH = 'icon-refresh';
    const ICON_LIST_ALT = 'icon-list-alt';
    const ICON_LOCK = 'icon-lock';
    const ICON_FLAG = 'icon-flag';
    const ICON_HEADPHONES = 'icon-headphones';
    const ICON_VOLUME_OFF = 'icon-volume-off';
    const ICON_VOLUME_DOWN = 'icon-volume-down';
    const ICON_VOLUME_UP = 'icon-volume-up';
    const ICON_QRCODE = 'icon-qrcode';
    const ICON_BARCODE = 'icon-barcode';
    const ICON_TAG = 'icon-tag';
    const ICON_TAGS = 'icon-tags';
    const ICON_BOOK = 'icon-book';
    const ICON_BOOKMARK = 'icon-bookmark';
    const ICON_PRINT = 'icon-print';
    const ICON_CAMERA = 'icon-camera';
    const ICON_FONT = 'icon-font';
    const ICON_BOLD = 'icon-bold';
    const ICON_ITALIC = 'icon-italic';
    const ICON_TEXT_HEIGHT = 'icon-text-height';
    const ICON_TEXT_WIDTH = 'icon-text-width';
    const ICON_ALIGN_LEFT = 'icon-align-left';
    const ICON_ALIGN_CENTER = 'icon-align-center';
    const ICON_ALIGN_RIGHT = 'icon-align-right';
    const ICON_ALIGN_JUSTIFY = 'icon-align-justify';
    const ICON_LIST = 'icon-list';
    const ICON_INDENT_LEFT = 'icon-indent-left';
    const ICON_INDENT_RIGHT = 'icon-indent-right';
    const ICON_FACETIME_VIDEO = 'icon-facetime-video';
    const ICON_PICTURE = 'icon-picture';
    const ICON_PENCIL = 'icon-pencil';
    const ICON_MAP_MARKER = 'icon-map-marker';
    const ICON_ADJUST = 'icon-adjust';
    const ICON_TINT = 'icon-tint';
    const ICON_EDIT = 'icon-edit';
    const ICON_SHARE = 'icon-share';
    const ICON_CHECK = 'icon-check';
    const ICON_MOVE = 'icon-move';
    const ICON_STEP_BACKWARD = 'icon-step-backward';
    const ICON_FAST_BACKWARD = 'icon-fast-backward';
    const ICON_BACKWARD = 'icon-backward';
    const ICON_PLAY = 'icon-play';
    const ICON_PAUSE = 'icon-pause';
    const ICON_STOP = 'icon-pause';
    const ICON_FORWARD = 'icon-forward';
    const ICON_FAST_FORWARD = 'icon-fast-forward';
    const ICON_STEP_FORWARD = 'icon-step-forward';
    const ICON_EJECT = 'icon-eject';
    const ICON_CHEVRON_LEFT = 'icon-chevron-left';
    const ICON_CHEVRON_RIGHT = 'icon-chevron-right';
    const ICON_PLUS_SIGN = 'icon-plus-sign';
    const ICON_MINUS_SIGN = 'icon-minus-sign';
    const ICON_REMOVE_SIGN = 'icon-remove-sign';
    const ICON_OK_SIGN = 'icon-ok-sign';
    const ICON_QUESTION_SIGN = 'icon-question-sign';
    const ICON_INFO_SIGN = 'icon-info-sign';
    const ICON_SCREENSHOT = 'icon-screenshot';
    const ICON_REMOVE_CIRCLE = 'icon-remove-circle';
    const ICON_OK_CIRCLE = 'icon-ok-circle';
    const ICON_BAN_CIRCLE = 'icon-ban-circle';
    const ICON_ARROW_LEFT = 'icon-arrow-left';
    const ICON_ARROW_RIGHT = 'icon-arrow-right';
    const ICON_ARROW_UP = 'icon-arrow-up';
    const ICON_ARROW_DOWN = 'icon-arrow-down';
    const ICON_SHARE_ALT = 'icon-share-alt';
    const ICON_RESIZE_FULL = 'icon-resize-full';
    const ICON_RESIZE_SMALL = 'icon-resize-small';
    const ICON_PLUS = 'icon-plus';
    const ICON_MINUS = 'icon-minus';
    const ICON_ASTERISK = 'icon-asterisk';
    const ICON_EXCLAMATION_SIGN = 'icon-exclamation-sign';
    const ICON_GIFT = 'icon-gift';
    const ICON_LEAF = 'icon-leaf';
    const ICON_FIRE = 'icon-fire';
    const ICON_EYE_OPEN = 'icon-eye-open';
    const ICON_EYE_CLOSE = 'icon-eye-close';
    const ICON_WARNING_SIGN = 'icon-warning-sign';
    const ICON_PLANE = 'icon-plane';
    const ICON_CALENDAR = 'icon-calendar';
    const ICON_RANDOM = 'icon-random';
    const ICON_COMMENT = 'icon-comment';
    const ICON_MAGNET = 'icon-magnet';
    const ICON_CHEVRON_UP = 'icon-chevron-up';
    const ICON_CHEVRON_DOWN = 'icon-chevron-down';
    const ICON_RETWEET = 'icon-retweet';
    const ICON_SHOPPING_CART = 'icon-shopping-cart';
    const ICON_FOLDER_CLOSE = 'icon-folder-close';
    const ICON_FOLDER_OPEN = 'icon-folder-open';
    const ICON_RESIZE_VERTICAL = 'icon-resize-vertical';
    const ICON_RESIZE_HORIZONTAL = 'icon-resize-horizontal';
    const ICON_HDD = 'icon-hdd';
    const ICON_BULLHORN = 'icon-bullhorn';
    const ICON_BELL = 'icon-bell';
    const ICON_CERTFICATE = 'icon-certificate';
    const ICON_THUMBS_UP = 'icon-thumbs-up';
    const ICON_THUMBS_DOWN = 'icon-thumbs-down';
    const ICON_HAND_RIGHT = 'icon-hand-right';
    const ICON_HAND_LEFT = 'icon-hand-left';
    const ICON_HAND_UP = 'icon-hand-up';
    const ICON_HAND_DOWN = 'icon-hand-down';
    const ICON_CIRCLE_ARROW_RIGHT = 'icon-circle-arrow-right';
    const ICON_CIRCLE_ARROW_LEFT = 'icon-circle-arrow-left';
    const ICON_CIRCLE_ARROW_UP = 'icon-circle-arrow-up';
    const ICON_CIRCLE_ARROW_DOWN = 'icon-circle-arrow-down';
    const ICON_GLOBE = 'icon-globe';
    const ICON_WRENCH = 'icon-wrench';
    const ICON_TASKS = 'icon-tasks';
    const ICON_FILTER = 'icon-filter';
    const ICON_BRIEFCASE = 'icon-briefcase';
    const ICON_FULLSCREEN = 'icon-fullscreen';

    // Default close text.
    const CLOSE_TEXT = '&times;';

    /**
     * @var string the CSS class for displaying error summaries.
     */
    public static $errorSummaryCss = 'alert alert-block alert-error';

    //
    // BASE CSS
    // --------------------------------------------------

    // Typography
    // http://twitter.github.io/bootstrap/2.3.2/base-css.html#typography
    // --------------------------------------------------

    /**
     * Generates a paragraph that stands out.
     * @param string $text the lead text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated paragraph.
     */
    public static function lead($text, $htmlOptions = array())
    {
        self::addCssClass('lead', $htmlOptions);
        return self::tag('p', $htmlOptions, $text);
    }

    /**
     * Generates small text.
     * @param string $text the text to style.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function small($text, $htmlOptions = array())
    {
        return self::tag('small', $htmlOptions, $text);
    }

    /**
     * Generates bold text.
     * @param string $text the text to style.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function b($text, $htmlOptions = array())
    {
        return self::tag('strong', $htmlOptions, $text);
    }

    /**
     * Generates italic text.
     * @param string $text the text to style.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function i($text, $htmlOptions = array())
    {
        return self::tag('em', $htmlOptions, $text);
    }

    /**
     * Generates an emphasized text.
     * @param string $style the text style.
     * @param string $text the text to emphasize.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated text.
     */
    public static function em($text, $htmlOptions = array(), $tag = 'p')
    {
        $color = TbArray::popValue('color', $htmlOptions);
        if (TbArray::popValue('muted', $htmlOptions, false)) {
            self::addCssClass('muted', $htmlOptions);
        } else {
            if (!empty($color)) {
                self::addCssClass('text-' . $color, $htmlOptions);
            }
        }
        return self::tag($tag, $htmlOptions, $text);
    }

    /**
     * Generates a muted text block.
     * @param string $text the text.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated text block.
     */
    public static function muted($text, $htmlOptions = array(), $tag = 'p')
    {
        $htmlOptions['muted'] = true;
        return self::em($text, $htmlOptions, $tag);
    }

    /**
     * Generates a muted span.
     * @param string $text the text.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated span.
     */
    public static function mutedSpan($text, $htmlOptions = array())
    {
        return self::muted($text, $htmlOptions, 'span');
    }

    /**
     * Generates an abbreviation with a help text.
     * @param string $text the abbreviation.
     * @param string $word the word the abbreviation is for.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated abbreviation.
     */
    public static function abbr($text, $word, $htmlOptions = array())
    {
        if (TbArray::popValue('small', $htmlOptions, false)) {
            self::addCssClass('initialism', $htmlOptions);
        }
        $htmlOptions['title'] = $word;
        return self::tag('abbr', $htmlOptions, $text);
    }

    /**
     * Generates a small abbreviation with a help text.
     * @param string $text the abbreviation.
     * @param string $word the word the abbreviation is for.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated abbreviation.
     */
    public static function smallAbbr($text, $word, $htmlOptions = array())
    {
        $htmlOptions['small'] = true;
        return self::abbr($text, $word, $htmlOptions);
    }

    /**
     * Generates an address block.
     * @param string $quote the address text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated block.
     */
    public static function address($text, $htmlOptions = array())
    {
        return self::tag('address', $htmlOptions, $text);
    }

    /**
     * Generates a quote.
     * @param string $text the quoted text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated quote.
     */
    public static function quote($text, $htmlOptions = array())
    {
        $paragraphOptions = TbArray::popValue('paragraphOptions', $htmlOptions, array());
        $source = TbArray::popValue('source', $htmlOptions);
        $sourceOptions = TbArray::popValue('sourceOptions', $htmlOptions, array());
        $cite = TbArray::popValue('cite', $htmlOptions);
        $citeOptions = TbArray::popValue('citeOptions', $htmlOptions, array());
        $cite = isset($cite) ? ' ' . self::tag('cite', $citeOptions, $cite) : '';
        $source = isset($source) ? self::tag('small', $sourceOptions, $source . $cite) : '';
        $text = self::tag('p', $paragraphOptions, $text) . $source;
        return self::tag('blockquote', $htmlOptions, $text);
    }

    /**
     * Generates a help text.
     * @param string $text the help text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text.
     */
    public static function help($text, $htmlOptions = array())
    {
        $type = TbArray::popValue('type', $htmlOptions, self::HELP_TYPE_INLINE);
        self::addCssClass('help-' . $type, $htmlOptions);
        return self::tag($type === self::HELP_TYPE_INLINE ? 'span' : 'p', $htmlOptions, $text);
    }

    /**
     * Generates a help block.
     * @param string $text the help text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated block.
     */
    public static function helpBlock($text, $htmlOptions = array())
    {
        $htmlOptions['type'] = self::HELP_TYPE_BLOCK;
        return self::help($text, $htmlOptions);
    }

    // Code
    // http://twitter.github.io/bootstrap/2.3.2/base-css.html#code
    // --------------------------------------------------

    /**
     * Generates inline code.
     * @param string $code the code.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated code.
     */
    public static function code($code, $htmlOptions = array())
    {
        return self::tag('code', $htmlOptions, $code);
    }

    /**
     * Generates a code block.
     * @param string $code the code.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated block.
     */
    public static function codeBlock($code, $htmlOptions = array())
    {
        return self::tag('pre', $htmlOptions, $code);
    }

    /**
     * Generates an HTML element.
     * @param string $tag the tag name.
     * @param array $htmlOptions the element attributes.
     * @param mixed $content the content to be enclosed between open and close element tags.
     * @param boolean $closeTag whether to generate the close tag.
     * @return string the generated HTML element tag.
     */
    public static function tag($tag, $htmlOptions = array(), $content = false, $closeTag = true)
    {
        self::addSpanClass($htmlOptions);
        self::addPullClass($htmlOptions);
        self::addTextAlignClass($htmlOptions);
        return parent::tag($tag, $htmlOptions, $content, $closeTag);
    }

    /**
     * Generates an open HTML element.
     * @param string $tag the tag name.
     * @param array $htmlOptions the element attributes.
     * @return string the generated HTML element tag.
     */
    public static function openTag($tag, $htmlOptions = array())
    {
        return self::tag($tag, $htmlOptions, false, false);
    }

    // Tables
    // http://twitter.github.io/bootstrap/2.3.2/base-css.html#forms
    // --------------------------------------------------

    // todo: create table methods here.

    // Forms
    // http://twitter.github.io/bootstrap/2.3.2/base-css.html#tables
    // --------------------------------------------------

    /**
     * Generates a form tag.
     * @param string $layout the form layout.
     * @param string $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tag.
     */
    public static function formTb(
        $layout = self::FORM_LAYOUT_VERTICAL,
        $action = '',
        $method = 'post',
        $htmlOptions = array()
    ) {
        return self::beginFormTb($layout, $action, $method, $htmlOptions);
    }

    /**
     * Generates an open form tag.
     * @param string $layout the form layout.
     * @param string $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tag.
     */
    public static function beginFormTb(
        $layout = self::FORM_LAYOUT_VERTICAL,
        $action = '',
        $method = 'post',
        $htmlOptions = array()
    ) {
        if (!empty($layout)) {
            self::addCssClass('form-' . $layout, $htmlOptions);
        }
        return parent::beginForm($action, $method, $htmlOptions);
    }

    /**
     * Generates a stateful form tag.
     * @param mixed $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated form tag.
     */
    public static function statefulFormTb(
        $layout = self::FORM_LAYOUT_VERTICAL,
        $action = '',
        $method = 'post',
        $htmlOptions = array()
    ) {
        return self::formTb($layout, $action, $method, $htmlOptions)
        . self::tag('div', array('style' => 'display: none'), parent::pageStateField(''));
    }

    /**
     * Generates a text field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::textInputField
     */
    public static function textField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('text', $name, $value, $htmlOptions);
    }

    /**
     * Generates a password field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::textInputField
     */
    public static function passwordField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('password', $name, $value, $htmlOptions);
    }

    /**
     * Generates an url field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::textInputField
     */
    public static function urlField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('url', $name, $value, $htmlOptions);
    }

    /**
     * Generates an email field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::textInputField
     */
    public static function emailField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('email', $name, $value, $htmlOptions);
    }

    /**
     * Generates a number field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::textInputField
     */
    public static function numberField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('number', $name, $value, $htmlOptions);
    }

    /**
     * Generates a range field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::textInputField
     */
    public static function rangeField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('range', $name, $value, $htmlOptions);
    }

    /**
     * Generates a date field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::textInputField
     */
    public static function dateField($name, $value = '', $htmlOptions = array())
    {
        return self::textInputField('date', $name, $value, $htmlOptions);
    }

    /**
     * Generates a file field input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see CHtml::fileField
     */
    public static function fileField($name, $value = '', $htmlOptions = array())
    {
        return parent::fileField($name, $value, $htmlOptions);
    }

    /**
     * Generates a text area input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text area.
     */
    public static function textArea($name, $value = '', $htmlOptions = array())
    {
        $htmlOptions = self::normalizeInputOptions($htmlOptions);
        return parent::textArea($name, $value, $htmlOptions);
    }

    /**
     * Generates a radio button.
     * @param string $name the input name.
     * @param boolean $checked whether the radio button is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated radio button.
     */
    public static function radioButton($name, $checked = false, $htmlOptions = array())
    {
        $label = TbArray::popValue('label', $htmlOptions, false);
        $labelOptions = TbArray::popValue('labelOptions', $htmlOptions, array());
        self::addCssClass('radio', $labelOptions);
        $input = parent::radioButton($name, $checked, $htmlOptions);
        return self::createCheckBoxAndRadioButtonLabel($label, $input, $labelOptions);
    }

    /**
     * Generates a check box.
     * @param string $name the input name.
     * @param boolean $checked whether the check box is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated check box.
     */
    public static function checkBox($name, $checked = false, $htmlOptions = array())
    {
        $label = TbArray::popValue('label', $htmlOptions, false);
        $labelOptions = TbArray::popValue('labelOptions', $htmlOptions, array());
        self::addCssClass('checkbox', $labelOptions);
        $input = parent::checkBox($name, $checked, $htmlOptions);
        return self::createCheckBoxAndRadioButtonLabel($label, $input, $labelOptions);
    }

    /**
     * Generates a drop down list.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @return string the generated drop down list.
     */
    public static function dropDownList($name, $select, $data, $htmlOptions = array())
    {
        $displaySize = TbArray::popValue('displaySize', $htmlOptions);
        $htmlOptions = self::normalizeInputOptions($htmlOptions);
        if (!empty($displaySize)) {
            $htmlOptions['size'] = $displaySize;
        }
        return parent::dropDownList($name, $select, $data, $htmlOptions);
    }

    /**
     * Generates a list box.
     * @param string $name the input name.
     * @param mixed $select the selected value(s).
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list box
     */
    public static function listBox($name, $select, $data, $htmlOptions = array())
    {
        if (isset($htmlOptions['multiple'])) {
            if (substr($name, -2) !== '[]') {
                $name .= '[]';
            }
        }
        TbArray::defaultValue('displaySize', 4, $htmlOptions);
        return self::dropDownList($name, $select, $data, $htmlOptions);
    }

    /**
     * Generates a radio button list.
     * @param string $name name of the radio button list.
     * @param mixed $select selection of the radio buttons.
     * @param array $data $data value-label pairs used to generate the radio button list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function radioButtonList($name, $select, $data, $htmlOptions = array())
    {
        $inline = TbArray::popValue('inline', $htmlOptions, false);
        $separator = TbArray::popValue('separator', $htmlOptions, ' ');
        $container = TbArray::popValue('container', $htmlOptions, 'span');
        $containerOptions = TbArray::popValue('containerOptions', $htmlOptions, array());
        $labelOptions = TbArray::popValue('labelOptions', $htmlOptions, array());

        $items = array();
        $baseID = $containerOptions['id'] = TbArray::popValue('baseID', $htmlOptions, parent::getIdByName($name));

        $id = 0;
        foreach ($data as $value => $label) {
            $checked = !strcmp($value, $select);
            $htmlOptions['value'] = $value;
            $htmlOptions['id'] = $baseID . '_' . $id++;
            if ($inline) {
                $htmlOptions['label'] = $label;
                self::addCssClass('inline', $labelOptions);
                $htmlOptions['labelOptions'] = $labelOptions;
                $items[] = self::radioButton($name, $checked, $htmlOptions);
            } else {
                $option = self::radioButton($name, $checked, $htmlOptions);
                self::addCssClass('radio', $labelOptions);
                $items[] = self::label($option . ' ' . $label, false, $labelOptions);
            }
        }

        $inputs = implode($separator, $items);
        return !empty($container) ? self::tag($container, $containerOptions, $inputs) : $inputs;
    }

    /**
     * Generates an inline radio button list.
     * @param string $name name of the radio button list.
     * @param mixed $select selection of the radio buttons.
     * @param array $data $data value-label pairs used to generate the radio button list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function inlineRadioButtonList($name, $select, $data, $htmlOptions = array())
    {
        $htmlOptions['inline'] = true;
        return self::radioButtonList($name, $select, $data, $htmlOptions);
    }

    /**
     * Generates a check box list.
     * @param string $name name of the check box list.
     * @param mixed $select selection of the check boxes.
     * @param array $data $data value-label pairs used to generate the check box list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function checkBoxList($name, $select, $data, $htmlOptions = array())
    {
        $inline = TbArray::popValue('inline', $htmlOptions, false);
        $separator = TbArray::popValue('separator', $htmlOptions, ' ');
        $container = TbArray::popValue('container', $htmlOptions, 'span');
        $containerOptions = TbArray::popValue('containerOptions', $htmlOptions, array());
        $labelOptions = TbArray::popValue('labelOptions', $htmlOptions, array());

        if (substr($name, -2) !== '[]') {
            $name .= '[]';
        }

        $checkAll = TbArray::popValue('checkAll', $htmlOptions);
        $checkAllLast = TbArray::popValue('checkAllLast', $htmlOptions);
        if ($checkAll !== null) {
            $checkAllLabel = $checkAll;
            $checkAllLast = $checkAllLast !== null;
        }

        $items = array();
        $baseID = $containerOptions['id'] = TbArray::popValue('baseID', $htmlOptions, parent::getIdByName($name));
        $id = 0;
        $checkAll = true;

        foreach ($data as $value => $label) {
            $checked = !is_array($select) && !strcmp($value, $select) || is_array($select) && in_array($value, $select);
            $checkAll = $checkAll && $checked;
            $htmlOptions['value'] = $value;
            $htmlOptions['id'] = $baseID . '_' . $id++;
            if ($inline) {
                $htmlOptions['label'] = $label;
                self::addCssClass('inline', $labelOptions);
                $htmlOptions['labelOptions'] = $labelOptions;
                $items[] = self::checkBox($name, $checked, $htmlOptions);
            } else {
                self::addCssClass('checkbox', $labelOptions);
                $option = self::checkBox($name, $checked, $htmlOptions);
                $items[] = self::label($option . ' ' . $label, false, $labelOptions);
            }
        }

        if (isset($checkAllLabel)) {
            $htmlOptions['value'] = 1;
            $htmlOptions['id'] = $id = $baseID . '_all';
            $option = self::checkBox($id, $checkAll, $htmlOptions);
            $item = self::label($option . ' ' . $checkAllLabel, false, $labelOptions);
            if ($checkAllLast) {
                $items[] = $item;
            } else {
                array_unshift($items, $item);
            }
            $name = strtr($name, array('[' => '\\[', ']' => '\\]'));
            $js = <<<EOD
jQuery('#$id').click(function() {
	jQuery("input[name='$name']").prop('checked', this.checked);
});
jQuery("input[name='$name']").click(function() {
	jQuery('#$id').prop('checked', !jQuery("input[name='$name']:not(:checked)").length);
});
jQuery('#$id').prop('checked', !jQuery("input[name='$name']:not(:checked)").length);
EOD;
            $cs = Yii::app()->getClientScript();
            $cs->registerCoreScript('jquery');
            $cs->registerScript($id, $js);
        }

        $inputs = implode($separator, $items);
        return !empty($container) ? self::tag($container, $containerOptions, $inputs) : $inputs;
    }

    /**
     * Generates an inline check box list.
     * @param string $name name of the check box list.
     * @param mixed $select selection of the check boxes.
     * @param array $data $data value-label pairs used to generate the check box list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function inlineCheckBoxList($name, $select, $data, $htmlOptions = array())
    {
        $htmlOptions['inline'] = true;
        return self::checkBoxList($name, $select, $data, $htmlOptions);
    }

    /**
     * Generates an uneditable input.
     * @param string $value the value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     */
    public static function uneditableField($value, $htmlOptions = array())
    {
        self::addCssClass('uneditable-input', $htmlOptions);
        $htmlOptions = self::normalizeInputOptions($htmlOptions);
        return self::tag('span', $htmlOptions, $value);
    }

    /**
     * Generates a search input.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     */
    public static function searchQueryField($name, $value = '', $htmlOptions = array())
    {
        self::addCssClass('search-query', $htmlOptions);
        return self::textField($name, $value, $htmlOptions);
    }

    /**
     * Generates a control group with a text field.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function textFieldControlGroup($name, $value = '', $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_TEXT, $name, $value, $htmlOptions);
    }

    /**
     * Generates a control group with a password field.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::textInputField
     */
    public static function passwordFieldControlGroup($name, $value = '', $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_PASSWORD, $name, $value, $htmlOptions);
    }

    /**
     * Generates a control group with an url field.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function urlFieldControlGroup($name, $value = '', $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_URL, $name, $value, $htmlOptions);
    }

    /**
     * Generates a control group with an email field.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function emailFieldControlGroup($name, $value = '', $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_EMAIL, $name, $value, $htmlOptions);
    }

    /**
     * Generates a control group with a number field.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::textInputField
     */
    public static function numberFieldControlGroup($name, $value = '', $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_NUMBER, $name, $value, $htmlOptions);
    }

    /**
     * Generates a control group with a range field.
     * @param string $name the input name
     * @param string $value the input value
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function rangeFieldControlGroup($name, $value = '', $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_RANGE, $name, $value, $htmlOptions);
    }

    /**
     * Generates a control group with a file field.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function dateFieldControlGroup($name, $value = '', $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_DATE, $name, $value, $htmlOptions);
    }

    /**
     * Generates a control group with a text area.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function textAreaControlGroup($name, $value = '', $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_TEXTAREA, $name, $value, $htmlOptions);
    }

    /**
     * Generates a control group with a file field.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function fileFieldControlGroup($name, $value = '', $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_FILE, $name, $value, $htmlOptions);
    }

    /**
     * Generates a control group with a radio button.
     * @param string $name the input name.
     * @param string $checked whether the radio button is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function radioButtonControlGroup($name, $checked = false, $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_RADIOBUTTON, $name, $checked, $htmlOptions);
    }

    /**
     * Generates a control group with a check box.
     * @param string $name the input name.
     * @param string $checked whether the check box is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function checkBoxControlGroup($name, $checked = false, $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_CHECKBOX, $name, $checked, $htmlOptions);
    }

    /**
     * Generates a control group with a drop down list.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function dropDownListControlGroup($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_DROPDOWNLIST, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates a control group with a list box.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function listBoxControlGroup($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_LISTBOX, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates a control group with a radio button list.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function radioButtonListControlGroup($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_RADIOBUTTONLIST, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates a control group with an inline radio button list.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function inlineRadioButtonListControlGroup(
        $name,
        $select = '',
        $data = array(),
        $htmlOptions = array()
    ) {
        return self::controlGroup(self::INPUT_TYPE_INLINERADIOBUTTONLIST, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates a control group with a check box list.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function checkBoxListControlGroup($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_CHECKBOXLIST, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates a control group with an inline check box list.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function inlineCheckBoxListControlGroup($name, $select = '', $data = array(), $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_INLINECHECKBOXLIST, $name, $select, $htmlOptions, $data);
    }

    /**
     * Generates a control group with an uneditable field.
     * @param string $select the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function uneditableFieldControlGroup($value = '', $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_UNEDITABLE, '', $value, $htmlOptions);
    }

    /**
     * Generates a control group with a search field.
     * @param string $name the input name.
     * @param string $select the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::controlGroup
     */
    public static function searchQueryControlGroup($name, $value = '', $htmlOptions = array())
    {
        return self::controlGroup(self::INPUT_TYPE_SEARCH, $name, $value, $htmlOptions);
    }

    /**
     * Generates a form control group.
     * @param string $type the input type.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the generated control group.
     */
    public static function controlGroup($type, $name, $value = '', $htmlOptions = array(), $data = array())
    {
        $color = TbArray::popValue('color', $htmlOptions);
        $groupOptions = TbArray::popValue('groupOptions', $htmlOptions, array());
        $controlOptions = TbArray::popValue('controlOptions', $htmlOptions, array());
        $label = TbArray::popValue('label', $htmlOptions);
        $labelOptions = TbArray::popValue('labelOptions', $htmlOptions, array());

        if (in_array($type, array(self::INPUT_TYPE_CHECKBOX, self::INPUT_TYPE_RADIOBUTTON))) {
            $htmlOptions['label'] = $label;
            $htmlOptions['labelOptions'] = $labelOptions;
            $label = false;
        }

        $help = TbArray::popValue('help', $htmlOptions, '');
        $helpOptions = TbArray::popValue('helpOptions', $htmlOptions, array());
        if (!empty($help)) {
            $help = self::inputHelp($help, $helpOptions);
        }

        $input = isset($htmlOptions['input'])
            ? $htmlOptions['input']
            : self::createInput($type, $name, $value, $htmlOptions, $data);

        self::addCssClass('control-group', $groupOptions);
        if (!empty($color)) {
            self::addCssClass($color, $groupOptions);
        }
        self::addCssClass('control-label', $labelOptions);
        $output = self::openTag('div', $groupOptions);
        if ($label !== false) {
            $output .= parent::label($label, $name, $labelOptions);
        }
        $output .= self::controls($input . $help, $controlOptions);
        $output .= '</div>';
        return $output;
    }

    /**
     * Generates a custom (pre-rendered) form control group.
     * @param string $input the rendered input.
     * @param string $name the input name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     */
    public static function customControlGroup($input, $name, $htmlOptions = array())
    {
        $htmlOptions['input'] = $input;
        return self::controlGroup(self::INPUT_TYPE_CUSTOM, $name, '', $htmlOptions);
    }

    /**
     * Creates a form input of the given type.
     * @param string $type the input type.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the input.
     * @throws CException if the input type is invalid.
     */
    public static function createInput($type, $name, $value, $htmlOptions = array(), $data = array())
    {
        switch ($type) {
            case self::INPUT_TYPE_TEXT:
                return self::textField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_PASSWORD:
                return self::passwordField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_URL:
                return self::urlField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_EMAIL:
                return self::emailField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_NUMBER:
                return self::numberField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_RANGE:
                return self::rangeField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_DATE:
                return self::dateField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_TEXTAREA:
                return self::textArea($name, $value, $htmlOptions);
            case self::INPUT_TYPE_FILE:
                return self::fileField($name, $value, $htmlOptions);
            case self::INPUT_TYPE_RADIOBUTTON:
                return self::radioButton($name, $value, $htmlOptions);
            case self::INPUT_TYPE_CHECKBOX:
                return self::checkBox($name, $value, $htmlOptions);
            case self::INPUT_TYPE_DROPDOWNLIST:
                return self::dropDownList($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_LISTBOX:
                return self::listBox($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_CHECKBOXLIST:
                return self::checkBoxList($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_INLINECHECKBOXLIST:
                return self::inlineCheckBoxList($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_RADIOBUTTONLIST:
                return self::radioButtonList($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_INLINERADIOBUTTONLIST:
                return self::inlineRadioButtonList($name, $value, $data, $htmlOptions);
            case self::INPUT_TYPE_UNEDITABLE:
                return self::uneditableField($value, $htmlOptions);
            case self::INPUT_TYPE_SEARCH:
                return self::searchQueryField($name, $value, $htmlOptions);
            default:
                throw new CException('Invalid input type "' . $type . '".');
        }
    }

    /**
     * Generates an input HTML tag.
     * This method generates an input HTML tag based on the given input name and value.
     * @param string $type the input type.
     * @param string $name the input name.
     * @param string $value the input value.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input tag.
     */
    protected static function textInputField($type, $name, $value, $htmlOptions)
    {
        parent::clientChange('change', $htmlOptions);

        $htmlOptions = self::normalizeInputOptions($htmlOptions);

        $addOnClasses = self::getAddOnClasses($htmlOptions);
        $addOnOptions = TbArray::popValue('addOnOptions', $htmlOptions, array());
        self::addCssClass($addOnClasses, $addOnOptions);

        $prepend = TbArray::popValue('prepend', $htmlOptions, '');
        $prependOptions = TbArray::popValue('prependOptions', $htmlOptions, array());
        if (!empty($prepend)) {
            $prepend = self::inputAddOn($prepend, $prependOptions);
        }

        $append = TbArray::popValue('append', $htmlOptions, '');
        $appendOptions = TbArray::popValue('appendOptions', $htmlOptions, array());
        if (!empty($append)) {
            $append = self::inputAddOn($append, $appendOptions);
        }

        $output = '';
        if (!empty($addOnClasses)) {
            $output .= self::openTag('div', $addOnOptions);
        }
        $output .= $prepend . parent::inputField($type, $name, $value, $htmlOptions) . $append;
        if (!empty($addOnClasses)) {
            $output .= '</div>';
        }
        return $output;
    }

    /**
     * Generates a text field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::activeTextInputField
     */
    public static function activeTextField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('text', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a password field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::activeTextInputField
     */
    public static function activePasswordField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('password', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates an url field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::activeTextInputField
     */
    public static function activeUrlField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('url', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates an email field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::activeTextInputField
     */
    public static function activeEmailField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('email', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a number field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::activeTextInputField
     */
    public static function activeNumberField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('number', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a range field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::activeTextInputField
     */
    public static function activeRangeField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('range', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a date field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see self::activeTextInputField
     */
    public static function activeDateField($model, $attribute, $htmlOptions = array())
    {
        return self::activeTextInputField('date', $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a file field input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input field.
     * @see CHtml::activeFileField
     */
    public static function activeFileField($model, $attribute, $htmlOptions = array())
    {
        return parent::activeFileField($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a text area input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated text area.
     */
    public static function activeTextArea($model, $attribute, $htmlOptions = array())
    {
        $htmlOptions = self::normalizeInputOptions($htmlOptions);
        return parent::activeTextArea($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a radio button for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated radio button.
     */
    public static function activeRadioButton($model, $attribute, $htmlOptions = array())
    {
        $label = TbArray::popValue('label', $htmlOptions, false);
        $labelOptions = TbArray::popValue('labelOptions', $htmlOptions, array());
        self::addCssClass('radio', $labelOptions);
        $input = parent::activeRadioButton($model, $attribute, $htmlOptions);
        return self::createCheckBoxAndRadioButtonLabel($label, $input, $labelOptions);
    }

    /**
     * Generates a check box for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated check box.
     */
    public static function activeCheckBox($model, $attribute, $htmlOptions = array())
    {
        $label = TbArray::popValue('label', $htmlOptions, false);
        $labelOptions = TbArray::popValue('labelOptions', $htmlOptions, array());
        self::addCssClass('checkbox', $labelOptions);
        $input = parent::activeCheckBox($model, $attribute, $htmlOptions);
        return self::createCheckBoxAndRadioButtonLabel($label, $input, $labelOptions);
    }

    /**
     * Generates a label for a checkbox or radio input by wrapping the input.
     * @param string $label the label text.
     * @param string $input the input.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated label.
     */
    protected static function createCheckBoxAndRadioButtonLabel($label, $input, $htmlOptions)
    {
        list ($hidden, $input) = self::normalizeCheckBoxAndRadio($input);
        return $hidden . ($label !== false
            ? self::tag('label', $htmlOptions, $input . ' ' . $label)
            : $input);
    }

    /**
     * Normalizes the inputs in the given string by splitting them up into an array.
     * @param string $input the inputs.
     * @return array an array with the following structure: array($hidden, $input)
     */
    protected static function normalizeCheckBoxAndRadio($input)
    {
        $parts = preg_split("/(<.*?>)/", $input, 2, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        if (isset($parts[1])) {
            return $parts;
        } else {
            return array('', $parts[0]);
        }
    }

    /**
     * Generates a drop down list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @return string the generated drop down list.
     */
    public static function activeDropDownList($model, $attribute, $data, $htmlOptions = array())
    {
        $displaySize = TbArray::popValue('displaySize', $htmlOptions);
        $htmlOptions = self::normalizeInputOptions($htmlOptions);
        if (!empty($displaySize)) {
            $htmlOptions['size'] = $displaySize;
        }
        return parent::activeDropDownList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a list box for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list box
     */
    public static function activeListBox($model, $attribute, $data, $htmlOptions = array())
    {
        TbArray::defaultValue('displaySize', 4, $htmlOptions);
        return self::activeDropDownList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a radio button list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data $data value-label pairs used to generate the radio button list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function activeRadioButtonList($model, $attribute, $data, $htmlOptions = array())
    {
        parent::resolveNameID($model, $attribute, $htmlOptions);
        $selection = parent::resolveValue($model, $attribute);
        $name = TbArray::popValue('name', $htmlOptions);
        $uncheckValue = isset($htmlOptions['uncheckValue']) ? TbArray::popValue('uncheckValue', $htmlOptions) : '';
        $hiddenOptions = isset($htmlOptions['id']) ? array('id' => parent::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
        $hidden = isset($uncheckValue) ? parent::hiddenField($name, $uncheckValue, $hiddenOptions) : '';
        return $hidden . self::radioButtonList($name, $selection, $data, $htmlOptions);
    }

    /**
     * Generates an inline radio button list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data $data value-label pairs used to generate the radio button list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function activeInlineRadioButtonList($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions['inline'] = true;
        return self::activeRadioButtonList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates a check box list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data $data value-label pairs used to generate the check box list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function activeCheckBoxList($model, $attribute, $data, $htmlOptions = array())
    {
        parent::resolveNameID($model, $attribute, $htmlOptions);
        $selection = parent::resolveValue($model, $attribute);
        if ($model->hasErrors($attribute)) {
            parent::addErrorCss($htmlOptions);
        }
        $name = TbArray::popValue('name', $htmlOptions);
        $uncheckValue = isset($htmlOptions['uncheckValue']) ? TbArray::popValue('uncheckValue', $htmlOptions) : '';
        $hiddenOptions = isset($htmlOptions['id']) ? array('id' => parent::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
        $hidden = isset($uncheckValue) ? parent::hiddenField($name, $uncheckValue, $hiddenOptions) : '';
        return $hidden . self::checkBoxList($name, $selection, $data, $htmlOptions);
    }

    /**
     * Generates an inline check box list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data $data value-label pairs used to generate the check box list.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated list.
     */
    public static function activeInlineCheckBoxList($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions['inline'] = true;
        return self::activeCheckBoxList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Generates an uneditable input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     */
    public static function activeUneditableField($model, $attribute, $htmlOptions = array())
    {
        parent::resolveNameID($model, $attribute, $htmlOptions);
        $value = parent::resolveValue($model, $attribute);
        TbArray::removeValues(array('name', 'id'), $htmlOptions);
        return self::uneditableField($value, $htmlOptions);
    }

    /**
     * Generates a search query input for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input.
     */
    public static function activeSearchQueryField($model, $attribute, $htmlOptions = array())
    {
        self::addCssClass('search-query', $htmlOptions);
        return self::activeTextField($model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a text field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeTextFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_TEXT, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a password field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activePasswordFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_PASSWORD, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a url field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeUrlFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_URL, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a email field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeEmailFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_EMAIL, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a number field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeNumberFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_NUMBER, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a range field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeRangeFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_RANGE, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a date field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeDateFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_DATE, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a text area for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeTextAreaControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_TEXTAREA, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a file field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeFileFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_FILE, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a radio button for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeRadioButtonControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_RADIOBUTTON, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a check box for a model attribute.
     * @param string $name the input name.
     * @param string $checked whether the check box is checked.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeCheckBoxControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_CHECKBOX, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a drop down list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeDropDownListControlGroup($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_DROPDOWNLIST, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Generates a control group with a list box for a model attribute.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeListBoxControlGroup($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_LISTBOX, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Generates a control group with a radio button list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeRadioButtonListControlGroup(
        $model,
        $attribute,
        $data = array(),
        $htmlOptions = array()
    ) {
        return self::activeControlGroup(self::INPUT_TYPE_RADIOBUTTONLIST, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Generates a control group with an inline radio button list for a model attribute.
     * @param string $name the input name.
     * @param string $select the selected value.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeInlineRadioButtonListControlGroup(
        $model,
        $attribute,
        $data = array(),
        $htmlOptions = array()
    ) {
        return self::activeControlGroup(
            self::INPUT_TYPE_INLINERADIOBUTTONLIST,
            $model,
            $attribute,
            $htmlOptions,
            $data
        );
    }

    /**
     * Generates a control group with a check box list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeCheckBoxListControlGroup($model, $attribute, $data = array(), $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_CHECKBOXLIST, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Generates a control group with an inline check box list for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $data data for generating the list options (value=>display).
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeInlineCheckBoxListControlGroup(
        $model,
        $attribute,
        $data = array(),
        $htmlOptions = array()
    ) {
        return self::activeControlGroup(self::INPUT_TYPE_INLINECHECKBOXLIST, $model, $attribute, $htmlOptions, $data);
    }

    /**
     * Generates a control group with a uneditable field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeUneditableFieldControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_UNEDITABLE, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates a control group with a search field for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     * @see self::activeControlGroup
     */
    public static function activeSearchQueryControlGroup($model, $attribute, $htmlOptions = array())
    {
        return self::activeControlGroup(self::INPUT_TYPE_SEARCH, $model, $attribute, $htmlOptions);
    }

    /**
     * Generates an active form row.
     * @param string $type the input type.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the generated control group.
     */
    public static function activeControlGroup($type, $model, $attribute, $htmlOptions = array(), $data = array())
    {
        $color = TbArray::popValue('color', $htmlOptions);
        $groupOptions = TbArray::popValue('groupOptions', $htmlOptions, array());
        $controlOptions = TbArray::popValue('controlOptions', $htmlOptions, array());
        $label = TbArray::popValue('label', $htmlOptions);
        $labelOptions = TbArray::popValue('labelOptions', $htmlOptions, array());

        if (in_array($type, array(self::INPUT_TYPE_CHECKBOX, self::INPUT_TYPE_RADIOBUTTON))) {
            $htmlOptions['label'] = isset($label) ? $label : $model->getAttributeLabel($attribute);
            $htmlOptions['labelOptions'] = $labelOptions;
            $label = false;
        }
        if (isset($label) && $label !== false) {
            $labelOptions['label'] = $label;
        }

        $help = TbArray::popValue('help', $htmlOptions, '');
        $helpOptions = TbArray::popValue('helpOptions', $htmlOptions, array());
        if (!empty($help)) {
            $help = self::inputHelp($help, $helpOptions);
        }
        $error = TbArray::popValue('error', $htmlOptions, '');
        
        if ($error) {
            $htmlOptions['data-toggle'] = 'tooltip';
            $htmlOptions['data-original-title'] = $error;
            $htmlOptions['data-placement'] = 'right';
        }
        
        $input = isset($htmlOptions['input'])
            ? $htmlOptions['input']
            : self::createActiveInput($type, $model, $attribute, $htmlOptions, $data);

        self::addCssClass('control-group', $groupOptions);
        if (!empty($color)) {
            self::addCssClass($color, $groupOptions);
        }
        self::addCssClass('control-label', $labelOptions);
        $output = self::openTag('div', $groupOptions);
        if ($label !== false) {
            $output .= parent::activeLabelEx($model, $attribute, $labelOptions);
        }
        $output .= self::controls($input . $help, $controlOptions);
        $output .= '</div>';
        return $output;
    }

    /**
     * Generates a custom (pre-rendered) active form control group.
     * @param string $input the rendered input.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated control group.
     */
    public static function customActiveControlGroup($input, $model, $attribute, $htmlOptions = array())
    {
        $htmlOptions['input'] = $input;
        return self::activeControlGroup(self::INPUT_TYPE_CUSTOM, $model, $attribute, $htmlOptions);
    }

    /**
     * Creates an active form input of the given type.
     * @param string $type the input type.
     * @param CModel $model the model instance.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @param array $data data for multiple select inputs.
     * @return string the input.
     * @throws CException if the input type is invalid.
     */
    public static function createActiveInput($type, $model, $attribute, $htmlOptions = array(), $data = array())
    {
        switch ($type) {
            case self::INPUT_TYPE_TEXT:
                return self::activeTextField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_PASSWORD:
                return self::activePasswordField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_URL:
                return self::activeUrlField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_EMAIL:
                return self::activeEmailField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_NUMBER:
                return self::activeNumberField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_RANGE:
                return self::activeRangeField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_DATE:
                return self::activeDateField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_TEXTAREA:
                return self::activeTextArea($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_FILE:
                return self::activeFileField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_RADIOBUTTON:
                return self::activeRadioButton($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_CHECKBOX:
                return self::activeCheckBox($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_DROPDOWNLIST:
                return self::activeDropDownList($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_LISTBOX:
                return self::activeListBox($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_CHECKBOXLIST:
                return self::activeCheckBoxList($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_INLINECHECKBOXLIST:
                return self::activeInlineCheckBoxList($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_RADIOBUTTONLIST:
                return self::activeRadioButtonList($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_INLINERADIOBUTTONLIST:
                return self::activeInlineRadioButtonList($model, $attribute, $data, $htmlOptions);
            case self::INPUT_TYPE_UNEDITABLE:
                return self::activeUneditableField($model, $attribute, $htmlOptions);
            case self::INPUT_TYPE_SEARCH:
                return self::activeSearchQueryField($model, $attribute, $htmlOptions);
            default:
                throw new CException('Invalid input type "' . $type . '".');
        }
    }

    /**
     * Displays a summary of validation errors for one or several models.
     * @param mixed $model the models whose input errors are to be displayed.
     * @param string $header a piece of HTML code that appears in front of the errors.
     * @param string $footer a piece of HTML code that appears at the end of the errors.
     * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
     * @return string the error summary. Empty if no errors are found.
     */
    public static function errorSummary($model, $header = null, $footer = null, $htmlOptions = array())
    {
        // kind of a quick fix but it will do for now.
        self::addCssClass(self::$errorSummaryCss, $htmlOptions);
        return parent::errorSummary($model, $header, $footer, $htmlOptions);
    }

    /**
     * Displays the first validation error for a model attribute.
     * @param CModel $model the data model.
     * @param string $attribute the attribute name.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the rendered error. Empty if no errors are found.
     */
    public static function error($model, $attribute, $htmlOptions = array())
    {
        parent::resolveName($model, $attribute); // turn [a][b]attr into attr
        $error = $model->getError($attribute);
        return !empty($error) ? self::help($error, $htmlOptions) : '';
    }

    /**
     * Generates an input HTML tag  for a model attribute.
     * This method generates an input HTML tag based on the given input name and value.
     * @param string $type the input type.
     * @param CModel $model the data model.
     * @param string $attribute the attribute.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated input tag.
     */
    protected static function activeTextInputField($type, $model, $attribute, $htmlOptions)
    {
        parent::resolveNameID($model, $attribute, $htmlOptions);
        parent::clientChange('change', $htmlOptions);

        $htmlOptions = self::normalizeInputOptions($htmlOptions);

        $addOnClasses = self::getAddOnClasses($htmlOptions);
        $addOnOptions = TbArray::popValue('addOnOptions', $htmlOptions, array());
        self::addCssClass($addOnClasses, $addOnOptions);

        $prepend = TbArray::popValue('prepend', $htmlOptions, '');
        $prependOptions = TbArray::popValue('prependOptions', $htmlOptions, array());
        if (!empty($prepend)) {
            $prepend = self::inputAddOn($prepend, $prependOptions);
        }

        $append = TbArray::popValue('append', $htmlOptions, '');
        $appendOptions = TbArray::popValue('appendOptions', $htmlOptions, array());
        if (!empty($append)) {
            $append = self::inputAddOn($append, $appendOptions);
        }
        
        if ($model->hasErrors($attribute)) {
            $htmlOptions = array_merge($htmlOptions, array(
                'data-toggle' => "tooltip",
                'data-placement' => "right",
                'data-original-title' => $model->getError($attribute),
            ));
        }

        $output = '';
        if (!empty($addOnClasses)) {
            $output .= self::openTag('div', $addOnOptions);
        }
        $output .= $prepend . parent::activeInputField($type, $model, $attribute, $htmlOptions) . $append;
        if (!empty($addOnClasses)) {
            $output .= '</div>';
        }
        return $output;
    }

    /**
     * Returns the add-on classes based on the given options.
     * @param array $htmlOptions the options.
     * @return string the classes.
     */
    protected static function getAddOnClasses($htmlOptions)
    {
        $classes = array();
        if (TbArray::getValue('append', $htmlOptions)) {
            $classes[] = 'input-append';
        }
        if (TbArray::getValue('prepend', $htmlOptions)) {
            $classes[] = 'input-prepend';
        }
        return !empty($classes) ? implode(' ', $classes) : $classes;
    }

    /**
     * Generates an add-on for an input field.
     * @param string $addOn the add-on.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated add-on.
     */
    protected static function inputAddOn($addOn, $htmlOptions)
    {
        $addOnOptions = TbArray::popValue('addOnOptions', $htmlOptions, array());
        self::addCssClass('add-on', $addOnOptions);
        return strpos($addOn, 'btn') === false // buttons should not be wrapped in a span
            ? self::tag('span', $addOnOptions, $addOn)
            : $addOn;
    }

    /**
     * Generates a help text for an input field.
     * @param string $help the help text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated help text.
     */
    protected static function inputHelp($help, $htmlOptions)
    {
        $type = TbArray::popValue('type', $htmlOptions, self::HELP_TYPE_INLINE);
        return $type === self::HELP_TYPE_INLINE
            ? self::help($help, $htmlOptions)
            : self::helpBlock($help, $htmlOptions);
    }

    /**
     * Normalizes input options.
     * @param array $options the options.
     * @return array the normalized options.
     */
    protected static function normalizeInputOptions($options)
    {
        self::addSpanClass($options);
        self::addTextAlignClass($options);
        $size = TbArray::popValue('size', $options);
        if (TbArray::popValue('block', $options, false)) {
            self::addCssClass('input-block-level', $options);
        } else {
            if (!empty($size)) {
                self::addCssClass('input-' . $size, $options);
            }
        }
        return $options;
    }

    /**
     * Generates form controls.
     * @param mixed $controls the controls.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated controls.
     */
    public static function controls($controls, $htmlOptions = array())
    {
        self::addCssClass('controls', $htmlOptions);
        if (TbArray::popValue('row', $htmlOptions, false)) {
            self::addCssClass('controls-row', $htmlOptions);
        }
        $before = TbArray::popValue('before', $htmlOptions, '');
        $after = TbArray::popValue('after', $htmlOptions, '');
        if (is_array($controls)) {
            $controls = implode('', $controls);
        }
        $content = $before . $controls . $after;
        return self::tag('div', $htmlOptions, $content);
    }

    /**
     * Generates form controls row.
     * @param mixed $controls the controls.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated controls.
     */
    public static function controlsRow($controls, $htmlOptions = array())
    {
        $htmlOptions['row'] = true;
        return self::controls($controls, $htmlOptions);
    }

    /**
     * Generates form actions.
     * @param mixed $actions the actions.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated actions.
     */
    public static function formActions($actions, $htmlOptions = array())
    {
        self::addCssClass('form-actions', $htmlOptions);
        if (is_array($actions)) {
            $actions = implode(' ', $actions);
        }
        return self::tag('div', $htmlOptions, $actions);
    }

    /**
     * Generates a search form.
     * @param mixed $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML options.
     * @return string the generated form.
     */
    public static function searchForm($action, $method = 'post', $htmlOptions = array())
    {
        self::addCssClass('form-search', $htmlOptions);
        $inputOptions = TbArray::popValue('inputOptions', $htmlOptions, array());
        $inputOptions = TbArray::merge(array('type' => 'text', 'placeholder' => 'Search'), $inputOptions);
        $name = TbArray::popValue('name', $inputOptions, 'search');
        $value = TbArray::popValue('value', $inputOptions, '');
        $output = self::beginFormTb(self::FORM_LAYOUT_SEARCH, $action, $method, $htmlOptions);
        $output .= self::searchQueryField($name, $value, $inputOptions);
        $output .= parent::endForm();
        return $output;
    }

    // Buttons
    // http://twitter.github.io/bootstrap/2.3.2/base-css.html#buttons
    // --------------------------------------------------

    /**
     * Generates a hyperlink tag.
     * @param string $text link body. It will NOT be HTML-encoded.
     * @param mixed $url a URL or an action route that can be used to create a URL.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated hyperlink
     */
    public static function link($text, $url = '#', $htmlOptions = array())
    {
        $htmlOptions['href'] = parent::normalizeUrl($url);
        self::clientChange('click', $htmlOptions);
        return self::tag('a', $htmlOptions, $text);
    }

    /**
     * Generates an button.
     * @param string $label the button label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function button($label = 'Button', $htmlOptions = array())
    {
        return self::htmlButton($label, $htmlOptions);
    }

    /**
     * Generates an image submit button.
     * @param string $src the image URL
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function htmlButton($label = 'Button', $htmlOptions = array())
    {
        return self::btn(self::BUTTON_TYPE_HTML, $label, $htmlOptions);
    }

    /**
     * Generates a submit button.
     * @param string $label the button label
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function submitButton($label = 'Submit', $htmlOptions = array())
    {
        return self::btn(self::BUTTON_TYPE_SUBMIT, $label, $htmlOptions);
    }

    /**
     * Generates a reset button.
     * @param string $label the button label
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function resetButton($label = 'Reset', $htmlOptions = array())
    {
        return self::btn(self::BUTTON_TYPE_RESET, $label, $htmlOptions);
    }

    /**
     * Generates an image submit button.
     * @param string $src the image URL
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function imageButton($src, $htmlOptions = array())
    {
        return self::btn(self::BUTTON_TYPE_IMAGE, $src, $htmlOptions);
    }

    /**
     * Generates a link submit button.
     * @param string $label the button label.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button tag.
     */
    public static function linkButton($label = 'Submit', $htmlOptions = array())
    {
        return self::btn(self::BUTTON_TYPE_LINK, $label, $htmlOptions);
    }

    /**
     * Generates a link that can initiate AJAX requests.
     * @param string $text the link body (it will NOT be HTML-encoded.)
     * @param mixed $url the URL for the AJAX request.
     * @param array $ajaxOptions AJAX options.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function ajaxLink($text, $url, $ajaxOptions = array(), $htmlOptions = array())
    {
        if (!isset($htmlOptions['href'])) {
            $htmlOptions['href'] = '#';
        }
        $ajaxOptions['url'] = $url;
        $htmlOptions['ajax'] = $ajaxOptions;
        parent::clientChange('click', $htmlOptions);
        return self::tag('a', $htmlOptions, $text);
    }

    /**
     * Generates a push button that can initiate AJAX requests.
     * @param string $label the button label.
     * @param mixed $url the URL for the AJAX request.
     * @param array $ajaxOptions AJAX options.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function ajaxButton($label, $url, $ajaxOptions = array(), $htmlOptions = array())
    {
        $ajaxOptions['url'] = $url;
        $htmlOptions['ajaxOptions'] = $ajaxOptions;
        return self::btn(self::BUTTON_TYPE_AJAXBUTTON, $label, $htmlOptions);
    }

    /**
     * Generates a push button that can submit the current form in POST method.
     * @param string $label the button label
     * @param mixed $url the URL for the AJAX request.
     * @param array $ajaxOptions AJAX options.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function ajaxSubmitButton($label, $url, $ajaxOptions = array(), $htmlOptions = array())
    {
        $ajaxOptions['type'] = 'POST';
        $htmlOptions['type'] = 'submit';
        return self::ajaxButton($label, $url, $ajaxOptions, $htmlOptions);
    }

    // todo: add methods for input button and input submit.

    /**
     * Generates a button.
     * @param string $type the button type.
     * @param string $label the button label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function btn($type, $label, $htmlOptions = array())
    {
        self::addCssClass('btn', $htmlOptions);
        $color = TbArray::popValue('color', $htmlOptions);
        if (!empty($color)) {
            self::addCssClass('btn-' . $color, $htmlOptions);
        }
        $size = TbArray::popValue('size', $htmlOptions);
        if (!empty($size)) {
            self::addCssClass('btn-' . $size, $htmlOptions);
        }
        if (TbArray::popValue('block', $htmlOptions, false)) {
            self::addCssClass('btn-block', $htmlOptions);
        }
        if (TbArray::getValue('disabled', $htmlOptions, false)) {
            self::addCssClass('disabled', $htmlOptions);
            $htmlOptions['disabled'] = 'disabled';
        }
        $loading = TbArray::popValue('loading', $htmlOptions);
        if (!empty($loading)) {
            $htmlOptions['data-loading-text'] = $loading;
        }
        if (TbArray::popValue('toggle', $htmlOptions, false)) {
            $htmlOptions['data-toggle'] = 'button';
        }
        $icon = TbArray::popValue('icon', $htmlOptions);
        $iconOptions = TbArray::popValue('iconOptions', $htmlOptions, array());
        if (strpos($type, 'input') === false) {
            if (!empty($icon)) {
                $label = self::icon($icon, $iconOptions) . ' ' . $label;
            }
            $items = TbArray::popValue('items', $htmlOptions);
        }
        $dropdownOptions = $htmlOptions;
        TbArray::removeValues(array('groupOptions', 'menuOptions', 'dropup'), $htmlOptions);
        self::addSpanClass($htmlOptions); // must be called here as parent renders buttons
        self::addPullClass($htmlOptions); // must be called here as parent renders buttons
        return isset($items)
            ? self::btnDropdown($type, $label, $items, $dropdownOptions)
            : self::createButton($type, $label, $htmlOptions);
    }

    /**
     * Generates a button dropdown.
     * @param string $type the button type.
     * @param string $label the button label text.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    protected static function btnDropdown($type, $label, $items, $htmlOptions)
    {
        $menuOptions = TbArray::popValue('menuOptions', $htmlOptions, array());
        $groupOptions = TbArray::popValue('groupOptions', $htmlOptions, array());
        self::addCssClass('btn-group', $groupOptions);
        if (TbArray::popValue('dropup', $htmlOptions, false)) {
            self::addCssClass('dropup', $groupOptions);
        }
        $output = self::openTag('div', $groupOptions);
        if (TbArray::popValue('split', $htmlOptions, false)) {
            $output .= self::createButton($type, $label, $htmlOptions);
            $output .= self::dropdownToggleButton('', $htmlOptions);
        } else {
            $output .= self::dropdownToggleLink($label, $htmlOptions);
        }
        $output .= self::dropdown($items, $menuOptions);
        $output .= '</div>';
        return $output;
    }

    /**
     * Creates a button the of given type.
     * @param string $type the button type.
     * @param string $label the button label.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the button.
     * @throws CException if the button type is valid.
     */
    protected static function createButton($type, $label, $htmlOptions)
    {
        $url = TbArray::popValue('url', $htmlOptions, '#');
        $ajaxOptions = TbArray::popValue('ajaxOptions', $htmlOptions, array());
        switch ($type) {
            case self::BUTTON_TYPE_HTML:
                return parent::htmlButton($label, $htmlOptions);

            case self::BUTTON_TYPE_SUBMIT:
                $htmlOptions['type'] = 'submit';
                return parent::htmlButton($label, $htmlOptions);

            case self::BUTTON_TYPE_RESET:
                $htmlOptions['type'] = 'reset';
                return parent::htmlButton($label, $htmlOptions);

            case self::BUTTON_TYPE_IMAGE:
                return parent::imageButton($label, $htmlOptions);

            case self::BUTTON_TYPE_LINKBUTTON:
                return parent::linkButton($label, $htmlOptions);

            case self::BUTTON_TYPE_AJAXLINK:
                return parent::ajaxLink($label, $url, $ajaxOptions, $htmlOptions);

            case self::BUTTON_TYPE_AJAXBUTTON:
                $htmlOptions['ajax'] = $ajaxOptions;
                return parent::htmlButton($label, $htmlOptions);

            case self::BUTTON_TYPE_INPUTBUTTON:
                return parent::button($label, $htmlOptions);

            case self::BUTTON_TYPE_INPUTSUBMIT:
                $htmlOptions['type'] = 'submit';
                return parent::button($label, $htmlOptions);

            case self::BUTTON_TYPE_LINK:
                return self::link($label, $url, $htmlOptions);

            default:
                throw new CException('Invalid button type "' . $type . '".');
        }
    }

    // Images
    // http://twitter.github.io/bootstrap/2.3.2/base-css.html#images
    // --------------------------------------------------

    /**
     * Generates an image tag with rounded corners.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function imageRounded($src, $alt = '', $htmlOptions = array())
    {
        $htmlOptions['type'] = self::IMAGE_TYPE_ROUNDED;
        return self::image($src, $alt, $htmlOptions);
    }

    /**
     * Generates an image tag with circle.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function imageCircle($src, $alt = '', $htmlOptions = array())
    {
        $htmlOptions['type'] = self::IMAGE_TYPE_CIRCLE;
        return self::image($src, $alt, $htmlOptions);
    }

    /**
     * Generates an image tag within polaroid frame.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function imagePolaroid($src, $alt = '', $htmlOptions = array())
    {
        $htmlOptions['type'] = self::IMAGE_TYPE_POLAROID;
        return self::image($src, $alt, $htmlOptions);
    }

    /**
     * Generates an image tag.
     * @param string $src the image URL.
     * @param string $alt the alternative text display.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated image tag.
     */
    public static function image($src, $alt = '', $htmlOptions = array())
    {
        $type = TbArray::popValue('type', $htmlOptions);
        if (!empty($type)) {
            self::addCssClass('img-' . $type, $htmlOptions);
        }
        return parent::image($src, $alt, $htmlOptions);
    }

    // Icons by Glyphicons
    // http://twitter.github.io/bootstrap/2.3.2/base-css.html#icons
    // --------------------------------------------------

    /**
     * Generates an icon.
     * @param string $icon the icon type.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tagName the icon HTML tag.
     * @return string the generated icon.
     */
    public static function icon($icon, $htmlOptions = array(), $tagName = 'i')
    {
        if (is_string($icon)) {
            if ((strpos($icon, 'icon') === false) && (strpos($icon, 'fa') === false)) {
                $icon = 'icon-' . implode(' icon-', explode(' ', $icon));
            }
            self::addCssClass($icon, $htmlOptions);
            $color = TbArray::popValue('color', $htmlOptions);
            if (!empty($color) && $color === self::ICON_COLOR_WHITE) {
                self::addCssClass('icon-white', $htmlOptions);
            }
            return self::openTag($tagName, $htmlOptions) . parent::closeTag($tagName); // tag won't work in this case
        }
        return '';
    }

    //
    // COMPONENTS
    // --------------------------------------------------

    // Dropdowns
    // http://twitter.github.io/bootstrap/2.3.2/components.html#dropdowns
    // --------------------------------------------------

    /**
     * Generates a dropdown menu.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    protected static function dropdown($items, $htmlOptions = array())
    {
        TbArray::defaultValue('role', 'menu', $htmlOptions);
        self::addCssClass('dropdown-menu', $htmlOptions);
        return self::menu($items, $htmlOptions);
    }

    /**
     * Generates a dropdown toggle link.
     * @param string $label the link label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function dropdownToggleLink($label, $htmlOptions = array())
    {
        return self::dropdownToggle(self::BUTTON_TYPE_LINK, $label, $htmlOptions);
    }

    /**
     * Generates a dropdown toggle button.
     * @param string $label the button label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function dropdownToggleButton($label = '', $htmlOptions = array())
    {
        return self::dropdownToggle(self::BUTTON_TYPE_HTML, $label, $htmlOptions);
    }

    /**
     * Generates a dropdown toggle element.
     * @param string $tag the HTML tag.
     * @param string $label the element text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated element.
     */
    protected static function dropdownToggle($type, $label, $htmlOptions)
    {
        self::addCssClass('dropdown-toggle', $htmlOptions);
        $label .= ' <b class="caret"></b>';
        $htmlOptions['data-toggle'] = 'dropdown';
        return self::btn($type, $label, $htmlOptions);
    }

    /**
     * Generates a dropdown toggle menu item.
     * @param string $label the menu item text.
     * @param string $url the menu item URL.
     * @param array $htmlOptions additional HTML attributes.
     * @param int $depth the menu depth at which this link is located
     * @return string the generated menu item.
     */
    public static function dropdownToggleMenuLink($label, $url = '#', $htmlOptions = array(), $depth = 0)
    {
        self::addCssClass('dropdown-toggle', $htmlOptions);
        if ($depth === 0) {
            $label .= ' <b class="caret"></b>';
        }
        $htmlOptions['data-toggle'] = 'dropdown';
        return self::link($label, $url, $htmlOptions);
    }

    // Button groups
    // http://twitter.github.io/bootstrap/2.3.2/components.html#buttonGroups
    // --------------------------------------------------

    /**
     * Generates a button group.
     * @param array $buttons the button configurations.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated button group.
     */
    public static function buttonGroup(array $buttons, $htmlOptions = array())
    {
        if (!empty($buttons)) {
            self::addCssClass('btn-group', $htmlOptions);
            if (TbArray::popValue('vertical', $htmlOptions, false)) {
                self::addCssClass('btn-group-vertical', $htmlOptions);
            }
            $toggle = TbArray::popValue('toggle', $htmlOptions);
            if (!empty($toggle)) {
                $htmlOptions['data-toggle'] = 'buttons-' . $toggle;
            }
            $parentOptions = array(
                'color' => TbArray::popValue('color', $htmlOptions),
                'size' => TbArray::popValue('size', $htmlOptions),
                'disabled' => TbArray::popValue('disabled', $htmlOptions)
            );
            $output = self::openTag('div', $htmlOptions);
            foreach ($buttons as $buttonOptions) {
                if (isset($buttonOptions['visible']) && $buttonOptions['visible'] === false) {
                    continue;
                }
                // todo: consider removing the support for htmlOptions.
                $options = TbArray::popValue('htmlOptions', $buttonOptions, array());
                if (!empty($options)) {
                    $buttonOptions = TbArray::merge($options, $buttonOptions);
                }
                $buttonLabel = TbArray::popValue('label', $buttonOptions, '');
                $buttonOptions = TbArray::copyValues(array('color', 'size', 'disabled'), $parentOptions, $buttonOptions);
                $items = TbArray::popValue('items', $buttonOptions, array());
                if (!empty($items)) {
                    $output .= self::buttonDropdown($buttonLabel, $items, $buttonOptions);
                } else {
                	$ajaxOptions = TbArray::popValue('ajaxOptions', $buttonOptions, array());
                	if(!empty($ajaxOptions)) {	                
	                	$output .= self::ajaxButton($buttonLabel, TbArray::popValue('url', $ajaxOptions, '#'), $ajaxOptions, $buttonOptions);
	                } else {
	                    $output .= self::linkButton($buttonLabel, $buttonOptions);
	                }
                }
            }
            $output .= '</div>';
            return $output;
        }
        return '';
    }

    /**
     * Generates a vertical button group.
     * @param array $buttons the button configurations.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated button group.
     */
    public static function verticalButtonGroup(array $buttons, $htmlOptions = array())
    {
        $htmlOptions['vertical'] = true;
        return self::buttonGroup($buttons, $htmlOptions);
    }

    /**
     * Generates a button toolbar.
     * @param array $groups the button group configurations.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated button toolbar.
     */
    public static function buttonToolbar(array $groups, $htmlOptions = array())
    {
        if (!empty($groups)) {
            self::addCssClass('btn-toolbar', $htmlOptions);
            $parentOptions = array(
                'color' => TbArray::popValue('color', $htmlOptions),
                'size' => TbArray::popValue('size', $htmlOptions),
                'disabled' => TbArray::popValue('disabled', $htmlOptions)
            );
            $output = self::openTag('div', $htmlOptions);
            foreach ($groups as $groupOptions) {
                if (isset($groupOptions['visible']) && $groupOptions['visible'] === false) {
                    continue;
                }
                $items = TbArray::popValue('items', $groupOptions, array());
                if (empty($items)) {
                    continue;
                }
                // todo: consider removing the support for htmlOptions.
                $options = TbArray::popValue('htmlOptions', $groupOptions, array());
                if (!empty($options)) {
                    $groupOptions = TbArray::merge($options, $groupOptions);
                }
                $groupOptions = TbArray::copyValues(array('color', 'size', 'disabled'), $parentOptions, $groupOptions);
                $output .= self::buttonGroup($items, $groupOptions);
            }
            $output .= '</div>';
            return $output;
        }
        return '';
    }

    // Button dropdowns
    // http://twitter.github.io/bootstrap/2.3.2/components.html#buttonDropdowns
    // --------------------------------------------------

    /**
     * Generates a button with a dropdown menu.
     * @param string $label the button label text.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function buttonDropdown($label, $items, $htmlOptions = array())
    {
        $htmlOptions['items'] = $items;
        $type = TbArray::popValue('type', $htmlOptions, self::BUTTON_TYPE_LINKBUTTON);
        return self::btn($type, $label, $htmlOptions);
    }

    /**
     * Generates a button with a split dropdown menu.
     * @param string $label the button label text.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated button.
     */
    public static function splitButtonDropdown($label, $items, $htmlOptions = array())
    {
        $htmlOptions['split'] = true;
        return self::buttonDropdown($label, $items, $htmlOptions);
    }

    // Navs
    // http://twitter.github.io/bootstrap/2.3.2/components.html#navs
    // --------------------------------------------------

    /**
     * Generates a tab navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function tabs($items, $htmlOptions = array())
    {
        return self::nav(self::NAV_TYPE_TABS, $items, $htmlOptions);
    }

    /**
     * Generates a stacked tab navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function stackedTabs($items, $htmlOptions = array())
    {
        $htmlOptions['stacked'] = true;
        return self::tabs($items, $htmlOptions);
    }

    /**
     * Generates a pills navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function pills($items, $htmlOptions = array())
    {
        return self::nav(self::NAV_TYPE_PILLS, $items, $htmlOptions);
    }

    /**
     * Generates a stacked pills navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function stackedPills($items, $htmlOptions = array())
    {
        $htmlOptions['stacked'] = true;
        return self::pills($items, $htmlOptions);
    }

    /**
     * Generates a list navigation.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function navList($items, $htmlOptions = array())
    {
        foreach ($items as $i => $itemOptions) {
            if (is_string($itemOptions)) {
                continue;
            }
            if (!isset($itemOptions['url']) && !isset($itemOptions['items'])) {
                $label = TbArray::popValue('label', $itemOptions, '');
                $items[$i] = self::menuHeader($label, $itemOptions);
            }
        }
        return self::nav(self::NAV_TYPE_LIST, $items, $htmlOptions);
    }

    /**
     * Generates a navigation menu.
     * @param string $type the menu type.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function nav($type, $items, $htmlOptions = array())
    {
        self::addCssClass('nav', $htmlOptions);
        if (!empty($type)) {
            self::addCssClass('nav-' . $type, $htmlOptions);
        }
        $stacked = TbArray::popValue('stacked', $htmlOptions, false);
        if ($type !== self::NAV_TYPE_LIST && $stacked) {
            self::addCssClass('nav-stacked', $htmlOptions);
        }
        return self::menu($items, $htmlOptions);
    }

    /**
     * Generates a menu.
     * @param array $items the menu items.
     * @param array $htmlOptions additional HTML attributes.
     * @param integer $depth the current depth.
     * @return string the generated menu.
     */
    public static function menu(array $items, $htmlOptions = array(), $depth = 0)
    {
        // todo: consider making this method protected.
        if (!empty($items)) {
            $htmlOptions['role'] = 'menu';
            $output = self::openTag('ul', $htmlOptions);
            foreach ($items as $itemOptions) {
                if (is_string($itemOptions)) {
                    $output .= $itemOptions;
                } else {
                    if (isset($itemOptions['visible']) && $itemOptions['visible'] === false) {
                        continue;
                    }
                    // todo: consider removing the support for htmlOptions.
                    $options = TbArray::popValue('htmlOptions', $itemOptions, array());
                    if (!empty($options)) {
                        $itemOptions = TbArray::merge($options, $itemOptions);
                    }
                    $label = TbArray::popValue('label', $itemOptions, '');
                    if (TbArray::popValue('active', $itemOptions, false)) {
                        self::addCssClass('active', $itemOptions);
                    }
                    if (TbArray::popValue('disabled', $itemOptions, false)) {
                        self::addCssClass('disabled', $itemOptions);
                    }
                    if (!isset($itemOptions['linkOptions'])) {
                        $itemOptions['linkOptions'] = array();
                    }
                    $icon = TbArray::popValue('icon', $itemOptions);
                    if (!empty($icon)) {
                        $label = self::icon($icon) . ' ' . $label;
                    }
                    $items = TbArray::popValue('items', $itemOptions, array());
                    $url = TbArray::popValue('url', $itemOptions, false);
                    if (empty($items)) {
                        if (!$url) {
                            $output .= self::menuHeader($label);
                        } else {
                            $itemOptions['linkOptions']['tabindex'] = -1;
                            $output .= self::menuLink($label, $url, $itemOptions);
                        }
                    } else {
                        $output .= self::menuDropdown($label, $url, $items, $itemOptions, $depth);
                    }
                }
            }
            $output .= '</ul>';
            return $output;
        } else {
            return '';
        }
    }

    /**
     * Generates a menu link.
     * @param string $label the link label.
     * @param array $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu item.
     */
    public static function menuLink($label, $url, $htmlOptions = array())
    {
        TbArray::defaultValue('role', 'menuitem', $htmlOptions);
        $linkOptions = TbArray::popValue('linkOptions', $htmlOptions, array());
        $content = self::link($label, $url, $linkOptions);
        return self::tag('li', $htmlOptions, $content);
    }

    /**
     * Generates a menu dropdown.
     * @param string $label the link label.
     * @param string $url the link URL.
     * @param array $items the menu configuration.
     * @param array $htmlOptions additional HTML attributes.
     * @param integer $depth the current depth.
     * @return string the generated dropdown.
     */
    protected static function menuDropdown($label, $url, $items, $htmlOptions, $depth = 0)
    {
        self::addCssClass($depth === 0 ? 'dropdown' : 'dropdown-submenu', $htmlOptions);
        TbArray::defaultValue('role', 'menuitem', $htmlOptions);
        $linkOptions = TbArray::popValue('linkOptions', $htmlOptions, array());
        $menuOptions = TbArray::popValue('menuOptions', $htmlOptions, array());
        self::addCssClass('dropdown-menu', $menuOptions);
        if ($depth === 0) {
            $defaultId = parent::ID_PREFIX . parent::$count++;
            TbArray::defaultValue('id', $defaultId, $menuOptions);
            $menuOptions['aria-labelledby'] = $menuOptions['id'];
            $menuOptions['role'] = 'menu';
        }
        $output = self::openTag('li', $htmlOptions);
        $output .= self::dropdownToggleMenuLink($label, $url, $linkOptions, $depth);
        $output .= self::menu($items, $menuOptions, $depth + 1);
        $output .= '</li>';
        return $output;
    }

    /**
     * Generates a menu header.
     * @param string $label the header text.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated header.
     */
    public static function menuHeader($label, $htmlOptions = array())
    {
        self::addCssClass('nav-header', $htmlOptions);
        return self::tag('li', $htmlOptions, $label);
    }

    /**
     * Generates a menu divider.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu item.
     */
    public static function menuDivider($htmlOptions = array())
    {
        self::addCssClass('divider', $htmlOptions);
        return self::tag('li', $htmlOptions);
    }

    /**
     * Generates a tabbable tabs menu.
     * @param array $tabs the tab configurations.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function tabbableTabs($tabs, $htmlOptions = array())
    {
        return self::tabbable(self::NAV_TYPE_TABS, $tabs, $htmlOptions);
    }

    /**
     * Generates a tabbable pills menu.
     * @param array $tabs the tab configurations.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function tabbablePills($pills, $htmlOptions = array())
    {
        return self::tabbable(self::NAV_TYPE_PILLS, $pills, $htmlOptions);
    }

    /**
     * Generates a tabbable menu.
     * @param string $type the menu type.
     * @param array $tabs the tab configurations.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated menu.
     */
    public static function tabbable($type, $tabs, $htmlOptions = array())
    {
        self::addCssClass('tabbable', $htmlOptions);
        $placement = TbArray::popValue('placement', $htmlOptions);
        if (!empty($placement)) {
            self::addCssClass('tabs-' . $placement, $htmlOptions);
        }
        $menuOptions = TbArray::popValue('menuOptions', $htmlOptions, array());
        $contentOptions = TbArray::popValue('contentOptions', $htmlOptions, array());
        self::addCssClass('tab-content', $contentOptions);
        $panes = array();
        $items = self::normalizeTabs($tabs, $panes);
        $menu = self::nav($type, $items, $menuOptions);
        $content = self::tag('div', $contentOptions, implode('', $panes));
        $output = self::openTag('div', $htmlOptions);
        $output .= $placement === self::TABS_PLACEMENT_BELOW ? $content . $menu : $menu . $content;
        $output .= '</div>';
        return $output;
    }

    /**
     * Normalizes the tab configuration.
     * @param array $tabs the tab configuration.
     * @param array $panes a reference to the panes array.
     * @param integer $i the running index.
     * @return array the items.
     */
    protected static function normalizeTabs($tabs, &$panes, $i = 0)
    {
        $menuItems = array();
        foreach ($tabs as $tabOptions) {
            if (isset($tabOptions['visible']) && $tabOptions['visible'] === false) {
                continue;
            }
            $menuItem = array();
            $menuItem['icon'] = TbArray::popValue('icon', $tabOptions);
            $menuItem['label'] = TbArray::popValue('label', $tabOptions, '');
            $menuItem['active'] = TbArray::getValue('active', $tabOptions, false);
            $menuItem['disabled'] = TbArray::popValue('disabled', $tabOptions, false);
            $menuItem['linkOptions'] = TbArray::popValue('linkOptions', $tabOptions, array());
            $menuItem['htmlOptions'] = TbArray::popValue('htmlOptions', $tabOptions, array());
            $items = TbArray::popValue('items', $tabOptions, array());
            if (!empty($items)) {
                $menuItem['linkOptions']['data-toggle'] = 'dropdown';
                $menuItem['items'] = self::normalizeTabs($items, $panes, $i);
            } else {
                $paneOptions = TbArray::popValue('paneOptions', $tabOptions, array());
                $id = $paneOptions['id'] = TbArray::popValue('id', $tabOptions, 'tab_' . ++$i);
                $menuItem['linkOptions']['data-toggle'] = 'tab';
                $menuItem['url'] = '#' . $id;
                self::addCssClass('tab-pane', $paneOptions);
                if (TbArray::popValue('fade', $tabOptions, true)) {
                    self::addCssClass('fade', $paneOptions);
                }
                if (TbArray::popValue('active', $tabOptions, false)) {
                    self::addCssClass('active in', $paneOptions);
                }
                $paneContent = TbArray::popValue('content', $tabOptions, '');
                $panes[] = self::tag('div', $paneOptions, $paneContent);
            }
            $menuItems[] = $menuItem;
        }
        return $menuItems;
    }

    // Navbar
    // http://twitter.github.io/bootstrap/2.3.2/components.html#navbar
    // --------------------------------------------------

    /**
     * Generates a navbar.
     * @param string $content the navbar content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated navbar.
     */
    public static function navbar($content, $htmlOptions = array())
    {
        self::addCssClass('navbar', $htmlOptions);
        $display = TbArray::popValue('display', $htmlOptions);
        if (!empty($display)) {
            self::addCssClass('navbar-' . $display, $htmlOptions);
        }
        $color = TbArray::popValue('color', $htmlOptions);
        if (!empty($color)) {
            self::addCssClass('navbar-' . $color, $htmlOptions);
        }
        $innerOptions = TbArray::popValue('innerOptions', $htmlOptions, array());
        $tag = TbArray::popValue('tag', $htmlOptions, 'div');
        self::addCssClass('navbar-inner', $innerOptions);
        $output = self::openTag($tag, $htmlOptions);
        $output .= self::tag('div', $innerOptions, $content);
        $output .= self::closeTag($tag);
        return $output;
    }

    /**
     * Generates a brand link for the navbar.
     * @param string $label the link label text.
     * @param string $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function navbarBrandLink($label, $url, $htmlOptions = array())
    {
        self::addCssClass('brand', $htmlOptions);
        return self::link($label, $url, $htmlOptions);
    }

    /**
     * Generates a text for the navbar.
     * @param string $text the text.
     * @param array $htmlOptions additional HTML attributes.
     * @param string $tag the HTML tag.
     * @return string the generated text block.
     */
    public static function navbarText($text, $htmlOptions = array(), $tag = 'p')
    {
        self::addCssClass('navbar-text', $htmlOptions);
        return self::tag($tag, $htmlOptions, $text);
    }

    /**
     * Generates a menu divider for the navbar.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated divider.
     */
    public static function navbarMenuDivider($htmlOptions = array())
    {
        self::addCssClass('divider-vertical', $htmlOptions);
        return self::tag('li', $htmlOptions);
    }

    /**
     * Generates a navbar form.
     * @param mixed $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes
     * @return string the generated form.
     */
    public static function navbarForm($action, $method = 'post', $htmlOptions = array())
    {
        self::addCssClass('navbar-form', $htmlOptions);
        return self::form($action, $method, $htmlOptions);
    }

    /**
     * Generates a navbar search form.
     * @param mixed $action the form action URL.
     * @param string $method form method (e.g. post, get).
     * @param array $htmlOptions additional HTML attributes
     * @return string the generated form.
     */
    public static function navbarSearchForm($action, $method = 'post', $htmlOptions = array())
    {
        self::addCssClass('navbar-search', $htmlOptions);
        return self::searchForm($action, $method, $htmlOptions);
    }

    /**
     * Generates a collapse element.
     * @param string $target the CSS selector for the target element.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated icon.
     */
    public static function navbarCollapseLink($target, $htmlOptions = array())
    {
        self::addCssClass('btn btn-navbar', $htmlOptions);
        $htmlOptions['data-toggle'] = 'collapse';
        $htmlOptions['data-target'] = $target;
        $content = '<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>';
        return self::tag('a', $htmlOptions, $content);
    }

    // Breadcrumbs
    // http://twitter.github.io/bootstrap/2.3.2/components.html#breadcrumbs
    // --------------------------------------------------

    /**
     * Generates a breadcrumb menu.
     * @param array $links the breadcrumb links.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated breadcrumb.
     */
    public static function breadcrumbs($links, $htmlOptions = array())
    {
        $divider = TbArray::popValue('divider', $htmlOptions, '/');
        self::addCssClass('breadcrumb', $htmlOptions);
        $output = self::openTag('ul', $htmlOptions);
        foreach ($links as $label => $url) {
            if (is_string($label) || is_array($url)) {
                $output .= self::openTag('li');
                $output .= self::link($label, $url);
                $output .= self::tag('span', array('class' => 'divider'), $divider);
                $output .= '</li>';
            } else {
                $output .= self::tag('li', array('class' => 'active'), $url);
            }
        }
        $output .= '</ul>';
        return $output;
    }

    // Pagination
    // http://twitter.github.io/bootstrap/2.3.2/components.html#pagination
    // --------------------------------------------------

    /**
     * Generates a pagination.
     * @param array $items the pagination buttons.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated pagination.
     */
    public static function pagination(array $items, $htmlOptions = array())
    {
        if (!empty($items)) {
            self::addCssClass('pagination', $htmlOptions);
            $size = TbArray::popValue('size', $htmlOptions);
            if (!empty($size)) {
                self::addCssClass('pagination-' . $size, $htmlOptions);
            }
            $align = TbArray::popValue('align', $htmlOptions);
            if (!empty($align)) {
                self::addCssClass('pagination-' . $align, $htmlOptions);
            }
            $listOptions = TbArray::popValue('listOptions', $htmlOptions, array());
            $output = self::openTag('div', $htmlOptions);
            $output .= self::openTag('ul', $listOptions);
            foreach ($items as $itemOptions) {
                // todo: consider removing the support for htmlOptions.
                $options = TbArray::popValue('htmlOptions', $itemOptions, array());
                if (!empty($options)) {
                    $itemOptions = TbArray::merge($options, $itemOptions);
                }
                $label = TbArray::popValue('label', $itemOptions, '');
                $url = TbArray::popValue('url', $itemOptions, false);
                $output .= self::paginationLink($label, $url, $itemOptions);
            }
            $output .= '</ul></div>';
            return $output;
        }
        return '';
    }

    /**
     * Generates a pagination link.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function paginationLink($label, $url, $htmlOptions = array())
    {
        $linkOptions = TbArray::popValue('linkOptions', $htmlOptions, array());
        if (TbArray::popValue('active', $htmlOptions, false)) {
            self::addCssClass('active', $htmlOptions);
        }
        if (TbArray::popValue('disabled', $htmlOptions, false)) {
            self::addCssClass('disabled', $htmlOptions);
        }
        $content = self::link($label, $url, $linkOptions);
        return self::tag('li', $htmlOptions, $content);
    }

    /**
     * Generates a pager.
     * @param array $links the pager buttons.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated pager.
     */
    public static function pager(array $links, $htmlOptions = array())
    {
        if (!empty($links)) {
            self::addCssClass('pager', $htmlOptions);
            $output = self::openTag('ul', $htmlOptions);
            foreach ($links as $itemOptions) {
                // todo: consider removing the support for htmlOptions.
                $options = TbArray::popValue('htmlOptions', $itemOptions, array());
                if (!empty($options)) {
                    $itemOptions = TbArray::merge($options, $itemOptions);
                }
                $label = TbArray::popValue('label', $itemOptions, '');
                $url = TbArray::popValue('url', $itemOptions, false);
                $output .= self::pagerLink($label, $url, $itemOptions);
            }
            $output .= '</ul>';
            return $output;
        }
        return '';
    }

    /**
     * Generates a pager link.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function pagerLink($label, $url, $htmlOptions = array())
    {
        $linkOptions = TbArray::popValue('linkOptions', $htmlOptions, array());
        if (TbArray::popValue('previous', $htmlOptions, false)) {
            self::addCssClass('previous', $htmlOptions);
        }
        if (TbArray::popValue('next', $htmlOptions, false)) {
            self::addCssClass('next', $htmlOptions);
        }
        if (TbArray::popValue('disabled', $htmlOptions, false)) {
            self::addCssClass('disabled', $htmlOptions);
        }
        $content = self::link($label, $url, $linkOptions);
        return self::tag('li', $htmlOptions, $content);
    }

    // Labels and badges
    // http://twitter.github.io/bootstrap/2.3.2/components.html#labels-badges
    // --------------------------------------------------

    /**
     * Generates a label span.
     * @param string $label the label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated span.
     */
    public static function labelTb($label, $htmlOptions = array())
    {
        self::addCssClass('label', $htmlOptions);
        $color = TbArray::popValue('color', $htmlOptions);
        if (!empty($color)) {
            self::addCssClass('label-' . $color, $htmlOptions);
        }
        return self::tag('span', $htmlOptions, $label);
    }

    /**
     * Generates a badge span.
     * @param string $label the badge text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated span.
     */
    public static function badge($label, $htmlOptions = array())
    {
        self::addCssClass('badge', $htmlOptions);
        $color = TbArray::popValue('color', $htmlOptions);
        if (!empty($color)) {
            self::addCssClass('badge-' . $color, $htmlOptions);
        }
        return self::tag('span', $htmlOptions, $label);
    }

    // Typography
    // http://twitter.github.io/bootstrap/2.3.2/components.html#typography
    // --------------------------------------------------

    /**
     * Generates a hero unit.
     * @param string $heading the heading text.
     * @param string $content the content text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated hero unit.
     */
    public static function heroUnit($heading, $content, $htmlOptions = array())
    {
        self::addCssClass('hero-unit', $htmlOptions);
        $headingOptions = TbArray::popValue('headingOptions', $htmlOptions, array());
        $output = self::openTag('div', $htmlOptions);
        $output .= self::tag('h1', $headingOptions, $heading);
        $output .= $content;
        $output .= '</div>';
        return $output;
    }

    /**
     * Generates a pager header.
     * @param string $heading the heading text.
     * @param string $subtext the subtext.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated pager header.
     */
    public static function pageHeader($heading, $subtext, $htmlOptions = array())
    {
        self::addCssClass('page-header', $htmlOptions);
        $headerOptions = TbArray::popValue('headerOptions', $htmlOptions, array());
        $subtextOptions = TbArray::popValue('subtextOptions', $htmlOptions, array());
        $output = self::openTag('div', $htmlOptions);
        $output .= self::openTag('h1', $headerOptions);
        $output .= parent::encode($heading) . ' ' . self::tag('small', $subtextOptions, $subtext);
        $output .= '</h1>';
        $output .= '</div>';
        return $output;
    }

    // Thumbnails
    // http://twitter.github.io/bootstrap/2.3.2/components.html#thumbnails
    // --------------------------------------------------

    /**
     * Generates a list of thumbnails.
     * @param array $thumbnails the list configuration.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated thumbnails.
     */
    public static function thumbnails(array $thumbnails, $htmlOptions = array())
    {
        if (!empty($thumbnails)) {
            self::addCssClass('thumbnails', $htmlOptions);
            $defaultSpan = TbArray::popValue('span', $htmlOptions, 3);
            $output = self::openTag('ul', $htmlOptions);
            foreach ($thumbnails as $thumbnailOptions) {
                if (isset($thumbnailOptions['visible']) && $thumbnailOptions['visible'] === false) {
                    continue;
                }
                // todo: consider removing the support for htmlOptions.
                $options = TbArray::popValue('htmlOptions', $thumbnailOptions, array());
                if (!empty($options)) {
                    $thumbnailOptions = TbArray::merge($options, $thumbnailOptions);
                }
                $thumbnailOptions['itemOptions']['span'] = TbArray::popValue('span', $thumbnailOptions, $defaultSpan);
                $caption = TbArray::popValue('caption', $thumbnailOptions, '');
                $captionOptions = TbArray::popValue('captionOptions', $thumbnailOptions, array());
                self::addCssClass('caption', $captionOptions);
                $label = TbArray::popValue('label', $thumbnailOptions);
                $labelOptions = TbArray::popValue('labelOptions', $thumbnailOptions, array());
                if (!empty($label)) {
                    $caption = self::tag('h3', $labelOptions, $label) . $caption;
                }
                $content = !empty($caption) ? self::tag('div', $captionOptions, $caption) : '';
                $image = TbArray::popValue('image', $thumbnailOptions);
                $imageOptions = TbArray::popValue('imageOptions', $thumbnailOptions, array());
                $imageAlt = TbArray::popValue('alt', $imageOptions, '');
                if (!empty($image)) {
                    $content = parent::image($image, $imageAlt, $imageOptions) . $content;
                }
                $url = TbArray::popValue('url', $thumbnailOptions, false);
                $output .= $url !== false
                    ? self::thumbnailLink($content, $url, $thumbnailOptions)
                    : self::thumbnail($content, $thumbnailOptions);
            }
            $output .= '</ul>';
            return $output;
        } else {
            return '';
        }
    }

    /**
     * Generates a thumbnail.
     * @param string $content the thumbnail content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated thumbnail.
     */
    public static function thumbnail($content, $htmlOptions = array())
    {
        $itemOptions = TbArray::popValue('itemOptions', $htmlOptions, array());
        self::addCssClass('thumbnail', $htmlOptions);
        $output = self::openTag('li', $itemOptions);
        $output .= self::tag('div', $htmlOptions, $content);
        $output .= '</li>';
        return $output;
    }

    /**
     * Generates a link thumbnail.
     * @param string $content the thumbnail content.
     * @param mixed $url the url that the thumbnail links to.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated thumbnail.
     */
    public static function thumbnailLink($content, $url = '#', $htmlOptions = array())
    {
        $itemOptions = TbArray::popValue('itemOptions', $htmlOptions, array());
        self::addCssClass('thumbnail', $htmlOptions);
        $content = self::link($content, $url, $htmlOptions);
        return self::tag('li', $itemOptions, $content);
    }

    // Alerts
    // http://twitter.github.io/bootstrap/2.3.2/components.html#alerts
    // --------------------------------------------------

    /**
     * Generates an alert.
     * @param string $color the color of the alert.
     * @param string $message the message to display.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated alert.
     */
    public static function alert($color, $message, $htmlOptions = array())
    {
        self::addCssClass('alert', $htmlOptions);
        if (!empty($color)) {
            self::addCssClass('alert-' . $color, $htmlOptions);
        }
        if (TbArray::popValue('in', $htmlOptions, true)) {
            self::addCssClass('in', $htmlOptions);
        }
        if (TbArray::popValue('block', $htmlOptions, false)) {
            self::addCssClass('alert-block', $htmlOptions);
        }
        if (TbArray::popValue('fade', $htmlOptions, true)) {
            self::addCssClass('fade', $htmlOptions);
        }
        $closeText = TbArray::popValue('closeText', $htmlOptions, self::CLOSE_TEXT);
        $closeOptions = TbArray::popValue('closeOptions', $htmlOptions, array());
        $closeOptions['dismiss'] = self::CLOSE_DISMISS_ALERT;
        $output = self::openTag('div', $htmlOptions);
        $output .= $closeText !== false ? self::closeLink($closeText, '#', $closeOptions) : '';
        $output .= $message;
        $output .= '</div>';
        return $output;
    }

    /**
     * Generates an alert block.
     * @param string $color the color of the alert.
     * @param string $message the message to display.
     * @param array $htmlOptions additional HTML options.
     * @return string the generated alert.
     */
    public static function blockAlert($color, $message, $htmlOptions = array())
    {
        $htmlOptions['block'] = true;
        return self::alert($color, $message, $htmlOptions);
    }

    // Progress bars
    // http://twitter.github.io/bootstrap/2.3.2/components.html#progress
    // --------------------------------------------------

    /**
     * Generates a progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function progressBar($width = 0, $htmlOptions = array())
    {
        self::addCssClass('progress', $htmlOptions);
        $color = TbArray::popValue('color', $htmlOptions);
        if (!empty($color)) {
            self::addCssClass('progress-' . $color, $htmlOptions);
        }
        if (TbArray::popValue('striped', $htmlOptions, false)) {
            self::addCssClass('progress-striped', $htmlOptions);
        }
        if (TbArray::popValue('animated', $htmlOptions, false)) {
            self::addCssClass('active', $htmlOptions);
        }
        $barOptions = TbArray::popValue('barOptions', $htmlOptions, array());
        $content = TbArray::popValue('content', $htmlOptions);
        if (!empty($content)) {
            $barOptions['content'] = $content;
        }
        $content = self::bar($width, $barOptions);
        return self::tag('div', $htmlOptions, $content);
    }

    /**
     * Generates a striped progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function stripedProgressBar($width = 0, $htmlOptions = array())
    {
        $htmlOptions['striped'] = true;
        return self::progressBar($width, $htmlOptions);
    }

    /**
     * Generates an animated progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function animatedProgressBar($width = 0, $htmlOptions = array())
    {
        $htmlOptions['animated'] = true;
        return self::stripedProgressBar($width, $htmlOptions);
    }

    /**
     * Generates a stacked progress bar.
     * @param array $bars the bar configurations.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated progress bar.
     */
    public static function stackedProgressBar(array $bars, $htmlOptions = array())
    {
        if (!empty($bars)) {
            self::addCssClass('progress', $htmlOptions);
            $output = self::openTag('div', $htmlOptions);
            $totalWidth = 0;
            foreach ($bars as $barOptions) {
                if (isset($barOptions['visible']) && !$barOptions['visible']) {
                    continue;
                }
                $width = TbArray::popValue('width', $barOptions, 0);
                $tmp = $totalWidth;
                $totalWidth += $width;
                if ($totalWidth > 100) {
                    $width = 100 - $tmp;
                }
                $output .= self::bar($width, $barOptions);
            }
            $output .= '</div>';
            return $output;
        }
        return '';
    }

    /**
     * Generates a progress bar.
     * @param integer $width the progress in percent.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated bar.
     */
    protected static function bar($width = 0, $htmlOptions = array())
    {
        self::addCssClass('bar', $htmlOptions);
        $color = TbArray::popValue('color', $htmlOptions);
        if (!empty($color)) {
            self::addCssClass('bar-' . $color, $htmlOptions);
        }
        if ($width < 0) {
            $width = 0;
        }
        if ($width > 100) {
            $width = 100;
        }
        if ($width > 0) {
            $width .= '%';
        }
        self::addCssStyle("width: {$width};", $htmlOptions);
        $content = TbArray::popValue('content', $htmlOptions, '');
        return self::tag('div', $htmlOptions, $content);
    }

    // Media objects
    // http://twitter.github.io/bootstrap/2.3.2/components.html#media
    // --------------------------------------------------

    /**
     * Generates a list of media objects.
     * @param array $items item configurations.
     * @param array $htmlOptions additional HTML attributes.
     * @return string generated list.
     */
    public static function mediaList(array $items, $htmlOptions = array())
    {
        if (!empty($items)) {
            self::addCssClass('media-list', $htmlOptions);
            $output = '';
            $output .= self::openTag('ul', $htmlOptions);
            $output .= self::medias($items, 'li');
            $output .= '</ul>';
            return $output;
        }
        return '';
    }

    /**
     * Generates multiple media objects.
     * @param array $items item configurations.
     * @param string $tag the item tag name.
     * @return string generated objects.
     */
    public static function medias(array $items, $tag = 'div')
    {
        if (!empty($items)) {
            $output = '';
            foreach ($items as $itemOptions) {
                if (isset($itemOptions['visible']) && $itemOptions['visible'] === false) {
                    continue;
                }
                // todo: consider removing the support for htmlOptions.
                $options = TbArray::popValue('htmlOptions', $itemOptions, array());
                if (!empty($options)) {
                    $itemOptions = TbArray::merge($options, $itemOptions);
                }
                $image = TbArray::popValue('image', $itemOptions);
                $heading = TbArray::popValue('heading', $itemOptions, '');
                $content = TbArray::popValue('content', $itemOptions, '');
                TbArray::defaultValue('tag', $tag, $itemOptions);
                $output .= self::media($image, $heading, $content, $itemOptions);
            }
            return $output;
        }
        return '';
    }

    /**
     * Generates a single media object.
     * @param string $image the image url.
     * @param string $heading the heading text.
     * @param string $content the content text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the media object.
     */
    public static function media($image, $heading, $content, $htmlOptions = array())
    {
        $tag = TbArray::popValue('tag', $htmlOptions, 'div');
        self::addCssClass('media', $htmlOptions);
        $linkOptions = TbArray::popValue('linkOptions', $htmlOptions, array());
        TbArray::defaultValue('pull', self::PULL_LEFT, $linkOptions);
        $imageOptions = TbArray::popValue('imageOptions', $htmlOptions, array());
        self::addCssClass('media-object', $imageOptions);
        $contentOptions = TbArray::popValue('contentOptions', $htmlOptions, array());
        self::addCssClass('media-body', $contentOptions);
        $headingOptions = TbArray::popValue('headingOptions', $htmlOptions, array());
        self::addCssClass('media-heading', $headingOptions);
        $items = TbArray::popValue('items', $htmlOptions);

        $output = self::openTag($tag, $htmlOptions);
        $alt = TbArray::popValue('alt', $imageOptions, '');
        $href = TbArray::popValue('href', $linkOptions, '#');
        if (!empty($image)) {
            $output .= self::link(parent::image($image, $alt, $imageOptions), $href, $linkOptions);
        }
        $output .= self::openTag('div', $contentOptions);
        $output .= self::tag('h4', $headingOptions, $heading);
        $output .= $content;
        if (!empty($items)) {
            $output .= self::medias($items);
        }
        $output .= '</div>';
        $output .= self::closeTag($tag);
        return $output;
    }

    // Misc
    // http://twitter.github.io/bootstrap/2.3.2/components.html#misc
    // --------------------------------------------------

    /**
     * Generates a well element.
     * @param string $content the well content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated well.
     */
    public static function well($content, $htmlOptions = array())
    {
        self::addCssClass('well', $htmlOptions);
        $size = TbArray::popValue('size', $htmlOptions);
        if (!empty($size)) {
            self::addCssClass('well-' . $size, $htmlOptions);
        }
        return self::tag('div', $htmlOptions, $content);
    }

    /**
     * Generates a close link.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function closeLink($label = self::CLOSE_TEXT, $url = '#', $htmlOptions = array())
    {
        $htmlOptions['href'] = $url;
        return self::close('a', $label, $htmlOptions);
    }

    /**
     * Generates a close button.
     * @param string $label the button label text.
     * @param array $htmlOptions the HTML options for the button.
     * @return string the generated button.
     */
    public static function closeButton($label = self::CLOSE_TEXT, $htmlOptions = array())
    {
        return self::close('button', $label, $htmlOptions);
    }

    /**
     * Generates a close element.
     * @param string $tag the tag name.
     * @param string $label the element label text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated element.
     */
    protected static function close($tag, $label, $htmlOptions = array())
    {
        self::addCssClass('close', $htmlOptions);
        $dismiss = TbArray::popValue('dismiss', $htmlOptions);
        if (!empty($dismiss)) {
            $htmlOptions['data-dismiss'] = $dismiss;
        }
        $htmlOptions['type'] = 'button';
        return self::tag($tag, $htmlOptions, $label);
    }

    /**
     * Generates a collapse link.
     * @param string $label the link label.
     * @param string $target the CSS selector.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function collapseLink($label, $target, $htmlOptions = array())
    {
        $htmlOptions['data-toggle'] = 'collapse';
        return self::link($label, $target, $htmlOptions);
    }

    //
    // JAVASCRIPT
    // --------------------------------------------------

    // Modals
    // http://twitter.github.io/bootstrap/2.3.2/javascript.html#modals
    // --------------------------------------------------

    /**
     * Generates a modal header.
     * @param string $content the header content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated header.
     */
    public static function modalHeader($content, $htmlOptions = array())
    {
        self::addCssClass('modal-header', $htmlOptions);
        $closeOptions = TbArray::popValue('closeOptions', $htmlOptions, array());
        $closeOptions['dismiss'] = 'modal';
        $headingOptions = TbArray::popValue('headingOptions', $htmlOptions, array());
        $closeLabel = TbArray::popValue('closeLabel', $htmlOptions, self::CLOSE_TEXT);
        $closeButton = self::closeButton($closeLabel, $closeOptions);
        $header = self::tag('h3', $headingOptions, $content);
        return self::tag('div', $htmlOptions, $closeButton . $header);
    }

    /**
     * Generates a modal body.
     * @param string $content the body content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated body.
     */
    public static function modalBody($content, $htmlOptions = array())
    {
        self::addCssClass('modal-body', $htmlOptions);
        return self::tag('div', $htmlOptions, $content);
    }

    /**
     * Generates a modal footer.
     * @param string $content the footer content.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated footer.
     */
    public static function modalFooter($content, $htmlOptions = array())
    {
        self::addCssClass('modal-footer', $htmlOptions);
        return self::tag('div', $htmlOptions, $content);
    }

    // Tooltips and Popovers
    // http://twitter.github.io/bootstrap/2.3.2/javascript.html#tooltips
    // http://twitter.github.io/bootstrap/2.3.2/javascript.html#popovers
    // --------------------------------------------------

    /**
     * Generates a tooltip.
     * @param string $label the tooltip link label text.
     * @param mixed $url the link url.
     * @param string $content the tooltip content text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tooltip.
     */
    public static function tooltip($label, $url, $content, $htmlOptions = array())
    {
        $htmlOptions['rel'] = 'tooltip';
        return self::tooltipPopover($label, $url, $content, $htmlOptions);
    }

    /**
     * Generates a popover.
     * @param string $label the popover link label text.
     * @param string $title the popover title text.
     * @param string $content the popover content text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated popover.
     */
    public static function popover($label, $title, $content, $htmlOptions = array())
    {
        $htmlOptions['rel'] = 'popover';
        $htmlOptions['data-content'] = $content;
        $htmlOptions['data-toggle'] = 'popover';
        return self::tooltipPopover($label, '#', $title, $htmlOptions);
    }

    /**
     * Generates a base tooltip.
     * @param string $label the tooltip link label text.
     * @param mixed $url the link url.
     * @param string $title the tooltip title text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated tooltip.
     */
    protected static function tooltipPopover($label, $url, $title, $htmlOptions)
    {
        $htmlOptions['title'] = $title;
        if (TbArray::popValue('animation', $htmlOptions)) {
            $htmlOptions['data-animation'] = 'true';
        }
        if (TbArray::popValue('html', $htmlOptions)) {
            $htmlOptions['data-html'] = 'true';
        }
        $selector = TbArray::popValue('selector', $htmlOptions);
        if (!empty($selector)) {
            $htmlOptions['data-selector'] = $selector;
        }
        $placement = TbArray::popValue('placement', $htmlOptions);
        if (!empty($placement)) {
            $htmlOptions['data-placement'] = $placement;
        }
        $trigger = TbArray::popValue('trigger', $htmlOptions);
        if (!empty($trigger)) {
            $htmlOptions['data-trigger'] = $trigger;
        }
        if (($delay = TbArray::popValue('delay', $htmlOptions)) !== null) {
            $htmlOptions['data-delay'] = $delay;
        }
        return self::link($label, $url, $htmlOptions);
    }

    // Carousel
    // http://twitter.github.io/bootstrap/2.3.2/javascript.html#carousel
    // --------------------------------------------------

    /**
     * Generates an image carousel.
     * @param array $items the item configurations.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated carousel.
     */
    public static function carousel(array $items, $htmlOptions = array())
    {
        if (!empty($items)) {
            $id = TbArray::getValue('id', $htmlOptions, parent::ID_PREFIX . parent::$count++);
            TbArray::defaultValue('id', $id, $htmlOptions);
            $selector = '#' . $id;
            self::addCssClass('carousel', $htmlOptions);
            if (TbArray::popValue('slide', $htmlOptions, true)) {
                self::addCssClass('slide', $htmlOptions);
            }
            $interval = TbArray::popValue('data-interval', $htmlOptions);
            if ($interval) {
                $htmlOptions['data-interval'] = $interval;
            }
            $pause = TbArray::popValue('data-pause', $htmlOptions);
            if ($pause) {
                $htmlOptions['data-pause'] = $pause;
            }
            $indicatorOptions = TbArray::popValue('indicatorOptions', $htmlOptions, array());
            $innerOptions = TbArray::popValue('innerOptions', $htmlOptions, array());
            self::addCssClass('carousel-inner', $innerOptions);
            $prevOptions = TbArray::popValue('prevOptions', $htmlOptions, array());
            $prevLabel = TbArray::popValue('label', $prevOptions, '&lsaquo;');
            $nextOptions = TbArray::popValue('nextOptions', $htmlOptions, array());
            $nextLabel = TbArray::popValue('label', $nextOptions, '&rsaquo;');
            $hidePrevAndNext = TbArray::popValue('hidePrevAndNext', $htmlOptions, false);
            $output = self::openTag('div', $htmlOptions);
            $output .= self::carouselIndicators($selector, count($items), $indicatorOptions);
            $output .= self::openTag('div', $innerOptions);
            foreach ($items as $i => $itemOptions) {
                if (isset($itemOptions['visible']) && $itemOptions['visible'] === false) {
                    continue;
                }
                if ($i === 0) { // first item should be active
                    self::addCssClass('active', $itemOptions);
                }
                $content = TbArray::popValue('content', $itemOptions, '');
                $image = TbArray::popValue('image', $itemOptions, '');
                $imageOptions = TbArray::popValue('imageOptions', $itemOptions, array());
                $imageAlt = TbArray::popValue('alt', $imageOptions, '');
                if (!empty($image)) {
                    $content = parent::image($image, $imageAlt, $imageOptions);
                }
                $label = TbArray::popValue('label', $itemOptions);
                $caption = TbArray::popValue('caption', $itemOptions);
                $output .= self::carouselItem($content, $label, $caption, $itemOptions);
            }
            $output .= '</div>';
            if (!$hidePrevAndNext) {
                $output .= self::carouselPrevLink($prevLabel, $selector, $prevOptions);
                $output .= self::carouselNextLink($nextLabel, $selector, $nextOptions);
            }
            $output .= '</div>';
            return $output;
        }
        return '';
    }

    /**
     * Generates a carousel item.
     * @param string $content the content.
     * @param string $label the item label text.
     * @param string $caption the item caption text.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated item.
     */
    public static function carouselItem($content, $label, $caption, $htmlOptions = array())
    {
        self::addCssClass('item', $htmlOptions);
        $overlayOptions = TbArray::popValue('overlayOptions', $htmlOptions, array());
        self::addCssClass('carousel-caption', $overlayOptions);
        $labelOptions = TbArray::popValue('labelOptions', $htmlOptions, array());
        $captionOptions = TbArray::popValue('captionOptions', $htmlOptions, array());
        $url = TbArray::popValue('url', $htmlOptions, false);
        if ($url !== false) {
            $content = self::link($content, $url);
        }
        $output = self::openTag('div', $htmlOptions);
        $output .= $content;
        if (isset($label) || isset($caption)) {
            $output .= self::openTag('div', $overlayOptions);
            if ($label) {
                $output .= self::tag('h4', $labelOptions, $label);
            }
            if ($caption) {
                $output .= self::tag('p', $captionOptions, $caption);
            }
            $output .= '</div>';
        }
        $output .= '</div>';
        return $output;
    }

    /**
     * Generates a previous link for the carousel.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function carouselPrevLink($label, $url = '#', $htmlOptions = array())
    {
        self::addCssClass('carousel-control left', $htmlOptions);
        $htmlOptions['data-slide'] = 'prev';
        return self::link($label, $url, $htmlOptions);
    }

    /**
     * Generates a next link for the carousel.
     * @param string $label the link label text.
     * @param mixed $url the link url.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated link.
     */
    public static function carouselNextLink($label, $url = '#', $htmlOptions = array())
    {
        self::addCssClass('carousel-control right', $htmlOptions);
        $htmlOptions['data-slide'] = 'next';
        return self::link($label, $url, $htmlOptions);
    }

    /**
     * Generates an indicator for the carousel.
     * @param string $target the CSS selector for the target element.
     * @param integer $numSlides the number of slides.
     * @param array $htmlOptions additional HTML attributes.
     * @return string the generated indicators.
     */
    public static function carouselIndicators($target, $numSlides, $htmlOptions = array())
    {
        self::addCssClass('carousel-indicators', $htmlOptions);
        $output = self::openTag('ol', $htmlOptions);
        for ($i = 0; $i < $numSlides; $i++) {
            $itemOptions = array('data-target' => $target, 'data-slide-to' => $i);
            if ($i === 0) {
                $itemOptions['class'] = 'active';
            }
            $output .= self::tag('li', $itemOptions, '', true);
        }
        $output .= '</ol>';
        return $output;
    }

    // UTILITIES
    // --------------------------------------------------

    /**
     * Appends new class names to the given options..
     * @param mixed $className the class(es) to append.
     * @param array $htmlOptions the options.
     * @return array the options.
     */
    public static function addCssClass($className, &$htmlOptions)
    {
        // Always operate on arrays
        if (is_string($className)) {
            $className = explode(' ', $className);
        }
        if (isset($htmlOptions['class'])) {
            $classes = array_filter(explode(' ', $htmlOptions['class']));
            foreach ($className as $class) {
                $class = trim($class);
                // Don't add the class if it already exists
                if (array_search($class, $classes) === false) {
                    $classes[] = $class;
                }
            }
            $className = $classes;
        }
        $htmlOptions['class'] = implode(' ', $className);
    }

    /**
     * Appends a CSS style string to the given options.
     * @param string $style the CSS style string.
     * @param array $htmlOptions the options.
     * @return array the options.
     */
    public static function addCssStyle($style, &$htmlOptions)
    {
        if (is_array($style)) {
            $style = implode('; ', $style);
        }
        $style = rtrim($style, ';');
        $htmlOptions['style'] = isset($htmlOptions['style'])
            ? rtrim($htmlOptions['style'], ';') . '; ' . $style
            : $style;
    }

    /**
     * Adds the grid span class to the given options is applicable.
     * @param array $htmlOptions the HTML attributes.
     */
    protected static function addSpanClass(&$htmlOptions)
    {
        $span = TbArray::popValue('span', $htmlOptions);
        if (!empty($span)) {
            self::addCssClass('span' . $span, $htmlOptions);
        }
    }

    /**
     * Adds the pull class to the given options is applicable.
     * @param array $htmlOptions the HTML attributes.
     */
    protected static function addPullClass(&$htmlOptions)
    {
        $pull = TbArray::popValue('pull', $htmlOptions);
        if (!empty($pull)) {
            self::addCssClass('pull-' . $pull, $htmlOptions);
        }
    }

    /**
     * Adds the text align class to the given options if applicable.
     * @param array $htmlOptions the HTML attributes.
     */
    protected static function addTextAlignClass(&$htmlOptions)
    {
        $align = TbArray::popValue('textAlign', $htmlOptions);
        if (!empty($align)) {
            self::addCssClass('text-' . $align, $htmlOptions);
        }
    }
}
