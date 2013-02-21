<?php

/**
 * @file controllers/grid/settings/library/form/NewLibraryFileForm.inc.php
 *
 * Copyright (c) 2003-2013 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class FileForm
 * @ingroup controllers_grid_file_form
 *
 * @brief Form for adding/edditing a file
 * stores/retrieves from an associative array
 */

import('controllers.grid.files.form.LibraryFileForm');

class NewLibraryFileForm extends LibraryFileForm {
	/**
	 * Constructor.
	 * @param $pressId int
	 */
	function NewLibraryFileForm($pressId) {
		parent::LibraryFileForm('controllers/grid/settings/library/form/newFileForm.tpl', $pressId);
		$this->addCheck(new FormValidator($this, 'temporaryFileId', 'required', 'settings.libraryFiles.fileRequired'));
	}

	/**
	 * Assign form data to user-submitted data.
	 * @see Form::readInputData()
	 */
	function readInputData() {
		$this->readUserVars(array('temporaryFileId'));
		return parent::readInputData();
	}

	/**
	 * Save the new library file.
	 * @param $userId int The current user ID (for validation purposes).
	 * @return $fileId int The new library file id.
	 */
	function execute($userId) {
		// Fetch the temporary file storing the uploaded library file
		$temporaryFileDao =& DAORegistry::getDAO('TemporaryFileDAO');
		$temporaryFile =& $temporaryFileDao->getTemporaryFile(
			$this->getData('temporaryFileId'),
			$userId
		);
		$libraryFileDao =& DAORegistry::getDAO('LibraryFileDAO');
		$libraryFileManager = new LibraryFileManager($this->pressId);

		// Convert the temporary file to a library file and store
		$libraryFile =& $libraryFileManager->copyFromTemporaryFile($temporaryFile, $this->getData('fileType'));
		assert($libraryFile);
		$libraryFile->setPressId($this->pressId);
		$libraryFile->setName($this->getData('libraryFileName'), null); // Localized
		$libraryFile->setType($this->getData('fileType'));

		$fileId = $libraryFileDao->insertObject($libraryFile);

		// Clean up the temporary file
		import('classes.file.TemporaryFileManager');
		$temporaryFileManager = new TemporaryFileManager();
		$temporaryFileManager->deleteFile($this->getData('temporaryFileId'), $userId);

		return $fileId;
	}
}

?>
