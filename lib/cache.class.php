<?php
class cache {

	private $cachepath = 'cache/';
	private $extension = 'cache';
	
	public function __construct() 
	{
		$this->checkCacheDir();
	}

	public function store($key, $data) 
	{
		$key = md5($key);
		$data = serialize($data);
		file_put_contents($this->cachepath.'/'.$key.'.'.$this->extension, $data);		
	}
  
	public function getCachedTime($key)
	{
		$key = md5($key);
		$path = $this->cachepath.'/'.$key.'.'.$this->extension;
		if(!file_exists($path))
			return false;
		return time() - filemtime($path);
	}
	
	public function load($key, $expire=0)
	{
		$key = md5($key);
		$path = $this->cachepath.'/'.$key.'.'.$this->extension;
		if( file_exists($path))
		{
			if(time() < (filemtime($path) + $expire) OR $expire == 0)
				return unserialize(file_get_contents($path));
			else
				unlink($path);
		}
		return false;
	}

	public function erase($key) 
	{
		$key = md5($key);
		$path = $this->cachepath.'/'.$key.'.'.$this->extension;
		if (file_exists($path))
			unlink($path);
		else
			return false;
		if (file_exists($path))
			return false;
		return true;
	}
	
	private function checkCacheDir() 
	{
		if (!is_dir($this->cachepath) && !mkdir($this->cachepath, 0775, true)) 
		{
			throw new Exception('Unable to create cache directory'.$this->cachepath);
		} 
		elseif (!is_readable($this->cachepath) || !is_writable($this->cachepath)) 
		{
			if (!chmod($this->cachepath, 0775)) 
			{
				throw new Exception($this->cachepath.' must be readable and writeable');
			}
		}
    return true;
  }
}