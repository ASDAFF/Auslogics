<?php
error_reporting(E_ALL);

if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
	$PartsURL = parse_url($_SERVER['HTTP_REFERER']);
	$referer = preg_replace('|^(www\.)?|i', '', $PartsURL['host']);
	setcookie('referrer', $referer);
}

$fileName = empty($_GET['file']) ? 'file.exe' : $_GET['file'] . '.exe';

$FileDownload = new FileDownload($fileName);

$FileDownload->process();


class FileDownload{

	/** @var string Название файла, который на самом деле будет загружен с сервера */
	private $__realFileName = 'file.exe';
	
	/** @var string Путь к папке с файлом, который будет загружен с сервера. Если задан, то обязателен ведущий слеш */
	private $__realFilePath = '';
	
	/** @var array HTTP заголовки, которые будут отданы браузеру */
	private $__Headers = array();
	
	/**
	 * Конструктор
	 *
	 * @param string $fileName Имя файла с расширением
	 * @param bool $changeRealFileName  Указывает надо ли вместо реального имени файла на сервере,
	 *									подставлять $fileName
	 *
	 */
	public function __construct($fileName, $changeRealFileName = true){
		$this->__changeRealFileName = $changeRealFileName;
		
		if ($changeRealFileName === false){
			$fileName = $this->__realFileName;
		}
		
		$this->setHeader('Content-Type', '"application/octet-stream"')
			 ->setHeader('Content-Disposition', 'attachment; filename="'.$fileName.'"')
			 ->setHeader('Content-Transfer-Encoding', 'binary')
			 ->setHeader('Expires', 0)
			 ->setHeader('Pragma', 'no-cache');
	}
	
	/**
	 * Начало загрузки файла
	 *
	 */
	public function process(){
		$fileContent = file_get_contents($this->__realFilePath . $this->__realFileName);
		
		$this->setHeader('Content-Length', strlen($fileContent));
		
		// Отдаем заголовки браузеру
		foreach ($this->__Headers as $key => $val){
			header ($key . ': ' . $val);
		}
		
		// Выходим и отдаем содержимое файла
		exit($fileContent);
	}
	
	/**
	 * Установка HTTP заголовков
	 *
	 * @param string $header Название заголовка
	 * @param string $header Значение заголовка
	 *
	 * @return FileDownload Этот метод можно использовать в цепочках
	 */
	public function setHeader($header, $value){
		$this->__Headers[$header] = $value;
		
		return $this;
	}
	
	/**
	 * Указание файла, который будет загружен с сервера
	 *
	 * @param string $fileName Имя файла с расширением
	 * @param string $filePath Папка с файлом
	 *
	 * @return bool
	 */
	public function setRealFile($fileName, $filePath = ''){
		// Добавление ведущего слеша, если его нет
		if(!empty($filePath) && substr($filePath, -1) != '/') {
			$filePath .= '/';
		}

		if (!file_exists($filePath . $fileName)){
			return false;
		}

		$this->__realFileName = $fileName;
		$this->__realFilePath = $filePath;
		
		return true;
	}
}
?>