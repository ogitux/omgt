<?php defined('SYSPATH') OR die('No direct access allowed.');
class View extends View_Core {
	
	public function __construct($name, $data = NULL, $type = NULL)
	{
        parent::__construct($name, $data, $type);
	}
	
	public function set_filename($name, $type = NULL)
	{
		if ($type == NULL)
		{
			// Load the filename and set the content type
			$this->kohana_filename = '/home/hypn/www/alpha/omgt/public_html'.Kohana::config('core.site_domain').'themes/default/'.$name.EXT;
			//$this->kohana_filename = Kohana::find_file('views', $name, TRUE);
			$this->kohana_filetype = EXT;
		}
		else
		{
			// Check if the filetype is allowed by the configuration
			if ( ! in_array($type, Kohana::config('view.allowed_filetypes')))
				throw new Kohana_Exception('core.invalid_filetype', $type);

			// Load the filename and set the content type
			
			$this->kohana_filename = Kohana::find_file('views', $name, TRUE, $type);
			$this->kohana_filetype = Kohana::config('mimes.'.$type);

			if ($this->kohana_filetype == NULL)
			{
				// Use the specified type
				$this->kohana_filetype = $type;
			}
		}

		return $this;
	}
	
}