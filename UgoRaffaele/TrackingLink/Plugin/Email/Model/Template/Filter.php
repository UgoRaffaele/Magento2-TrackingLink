<?php
namespace UgoRaffaele\TrackingLink\Plugin\Email\Model\Template;

class Filter {

    protected $class;
    protected $template;
	
    public function __construct(
		$class = null,
		$template = null
	) {
		$this->class = $class;
		$this->template = $template;
    }    
    
    public function beforeBlockDirective($subject, $construction)
    {
        if ($this->isDefaultTrackTemplate($construction[2])) {
			$construction[2] = $this->replaceBlockClass(
				$this->replaceTrackTemplate($construction[2])
			);
		}
        return [$construction];
    }

    protected function isDefaultTrackTemplate($string)
    {
        return (bool) preg_match(
			"#template='Magento_Sales::email\/shipment\/track\.phtml'#s", 
			$string
		);
    }
	
    protected function replaceBlockClass($string)
    {
        $class = $this->class;
		return preg_replace_callback(
            "#class='([^']+)'#s",
            function($match) use ($class) { 
				return "class='$class'";
			}, 
            $string
        ); 
    } 

    protected function replaceTrackTemplate($string)
    {
        $template = $this->template;
		return preg_replace_callback(
            "#template='([^']+)'#s",
            function($match) use ($template) { 
				return "template='$template'";
			}, 
            $string
        ); 
    }  
 	
}