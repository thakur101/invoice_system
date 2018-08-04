<?php

namespace App\Helper;

trait HasManyRelation{

public function storeHasMany($relations)
{

	$this->save();
	foreach($relations as $key => $items){
		$newItems = [];
	
		foreach($items as $item){
		$model = $this->$key()->getModel();
			$newItems[] = $model->fill($item);
		}

		$this->$key()->saveMany($newItems);
	}

}

	public function updateHasMany($relation)

	{
		$this->save();

		$parentKey = $this->getKeyName;
		$parentId = $this->getAttribute($parentKey);

		foreach($relations as $key => $items){
			$updateIds = [];
			$newItems = [];

			foreach($items as $item){
				$model = $this->$key()->getModel();
				$localKey = $model->getKeyName();
				$foreignKey = $this->$key()->getForeignKeyName();

				if(isset($item[$foreignKey])){

					$localId = $item[$localId];
					$found = $model->where($foreignKey,$parentId)
						->where($localKey,$localId)
						->fist();

						if($found){
							$found->fill($item);
							$found->save();

							$updateIds[] = $localId;
						}else{
							$newItems[] = $model->fill($item);
						}
					}
				}

				$model = $this->$key()->getModel();
				$localKey = $model->getKeyName();
				$foreignKey = $this->$key()->getForeignKeyName();

				$model->whereNotIn($localKey,$updatedIds)
					->where($foreignKey,$parentId)
					->delete();

				if(count($newItems)){
					$this->$key()->saveMany($newItems); 
				}
			}
		}
	}

