<?php
require_once(ROOT_DIR . 'lib/Domain/Resource.php');

interface IResourceRepository
{
	/**
	 * Gets all Resources for the given scheduleId
	 *
	 * @param int $scheduleId
	 * @return array[int]Resource
	 */
	public function GetScheduleResources($scheduleId);
}

class ResourceRepository implements IResourceRepository
{
	public function __construct() 
	{
	}
	
	/**
	 * @see IResourceRepository::GetScheduleResources()
	 */
	public function GetScheduleResources($scheduleId)
	{
		$command = new GetScheduleResourcesCommand($scheduleId);
		
		$resources = array();
		
		$reader = ServiceLocator::GetDatabase()->Query($command);
		
		while ($row = $reader->GetRow())
		{
			$resources[] = Resource::Create($row);
		}
		
		$reader->Free();
		
		return $resources;
	}
}

?>