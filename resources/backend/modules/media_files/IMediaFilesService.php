<?php

interface IMediaFilesService
{

    function saveMediaFileByFieldName($fieldName, $keyvalue);

    function saveMediaFileByFieldArray($field, $keyvalue);

    function getMediaLink($mediaId);

    function removeMedia($id);
}
?>