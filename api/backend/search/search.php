<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';

//include classes
include_once '../../classes/recipe.php';
include_once '../../classes/rating.php';
include_once '../../classes/ingredient.php';
include_once '../../classes/nutrient.php';

//instantiate database and product object
$database = new Connection();
$db = $database->connection();





$testData = array("Erdbeere", "Banane");
// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
  echo $request . '\n';
}


function search($_keywords, $_conn){

  //Basic Recipe Search
 $_query = 'SELECT * FROM (
                    SELECT r.R_ID, 
                            r.Title, 
                            r.picture, 
                            r.servings, 
                            r.R_Descr, 
                            r.instruction, 
                            r.creationDate, 
                            r.Duration, 
                            r.Difficulty, 
                            r.certified, 
                            r.LastChange, 
                            r.U_ID, 
                            keywords.KW_ID, 
                            food.F_ID, 
                            food.F_Descr, 
                            ingredient.Amount AS IngredientAmount,
                            ingredient.Unit AS IngredientUnit,
                            keywords.KW_Name, 
                            BananaAmount, 
                            Comment, 
                            rating.U_ID AS RatingUserId,
                            PU_ID, 
                            FavDate, 
                            FavGroup, 
                            foodHasNutrients.N_ID, 
                            nutrients.N_Descr,
                            nutrients.N_Unit,  
                            foodHasNutrients.N_Amount
                    FROM recipe r 
                      LEFT join recipeHasKeywords
                        ON r.R_ID = recipeHasKeywords.R_ID
                      left join keywords
                        ON keywords.KW_ID = recipeHasKeywords.KW_ID
                          left join ingredient
                        ON r.R_ID = ingredient.R_ID
                      left join food
                        ON food.F_ID = ingredient.F_ID     
                      left join foodHasNutrients
                        ON food.F_ID = foodHasNutrients.F_ID
                      left join nutrients
                        ON nutrients.N_ID = foodHasNutrients.N_ID
                      left join rating
                        ON r.R_ID = rating.R_ID
                      left join favourites
                        ON r.R_ID = favourites.R_ID
                          ORDER BY R_ID, food.F_ID
                              ) as tab1
                  WHERE KW_NAME LIKE :KW_Name
                  OR F_Descr LIKE :F_Descr';

    // prepare query statement
    $_stmt = $_conn->prepare($_query);

    //sanitize
    $_keywords=htmlspecialchars(strip_tags($_keywords));
    $_keywords = "%{$_keywords}%";

    //bind
    $_stmt->bindParam(":KW_Name", $_keywords);
    $_stmt->bindParam(":F_Descr", $_keywords);


    // execute query
    $_stmt->execute();



    return $_stmt;
}

//Call Function
$searchResults = search($testData, $db);
$num = $searchResults->rowCount();
//recipe
$lastID = -1;
$index = -1;
//ingredient
$ingredient = new Ingredient();
$lastIngredientId = -1;
$ingredientindex = -1;


if($num > 0){
  //Analyze search results
  $searchArray=array();
  $searchArray["message"]="";
  $searchArray["recipe"]=array();
  



  // retrieve our table contents
  // fetch() is faster than fetchAll()
  // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
  while ($row = $searchResults->fetch(PDO::FETCH_ASSOC)){
    // extract row
    // this will make $row['name'] to
    // just $name only
    extract($row);
    $changesingredient = false;

    //remember last recipe Id for push
    if($lastID != $R_ID){
      //unique recipe id
      $lastID = $R_ID;
      $index++;

      //instantiate classes
      $recipe = new Recipe();

      $recipe->setId($R_ID);
      $recipe->setTitle($Title);
      $recipe->setPicture($picture);
      $recipe->setDescription($R_Descr);
      $recipe->setInstruction($instruction);
      $recipe->setDuration($R_Descr);
      $recipe->setCreationDate($creationDate);
      $recipe->setLastChange($LastChange);
      $recipe->setDifficulty($Difficulty);
      $recipe->setCertified($certified);
      if($KW_Name != null) {$recipe->addKeyword($KW_Name);}
      $recipe->setServings($servings);
      $recipe->setCreatedUser($U_ID);
      
      $rating = new Rating($RatingUserId, $BananaAmount, $Comment);
      if($rating->getUserId() != null && $rating->getComment()!= null && $rating->getRating() != null){
        $recipe->addRating($rating->getObjectAsArray());
      }
      
      if($F_ID != null){
        $ingredient = new Ingredient();
        $ingredient->setId($F_ID);
        $ingredient->setDescription($F_Descr);
        $ingredient->setAmount($IngredientAmount);
        $ingredient->setUnit($IngredientUnit);
        
        //Update indexes
        $lastIngredientId = $F_ID;
        $ingredientindex++;

        if($N_ID != null){
          $nutrient = new Nutrient();
          $nutrient->setId($N_ID);
          $nutrient->setDescription($N_Descr);
          $nutrient->setUnit($N_Unit);
          $nutrient->setAmount($N_Amount);
          $lastNutrientId = $N_ID;
    
          $ingredient->addNutrient($nutrient->getObjectAsArray());
        }
        $recipe->addIngredient($ingredient->getObjectAsArray());
      }
    }
    else{
      //Same recipe id therefore extend properties

      //Extend object if not null
      if($KW_Name != null){$recipe->addKeyword($KW_Name);}

      $rating = new Rating($RatingUserId, $BananaAmount, $Comment);
      //Add only not emty Objects
      if($rating->getUserId() != null && $rating->getComment() != null && $rating->getRating() != null){
        $recipe->addRating($rating->getObjectAsArray());
      }

      //Only if ingredient exists
      if($F_ID != null){
        //Check if new Ingredient
        if($lastIngredientId != $F_ID || $ingredientindex == -1){
          $lastIngredientId = $F_ID;
          $ingredientindex++;
          $changesingredient = true;

          //create new Ingredient
          $ingredient = new Ingredient();
          $ingredient->setId($F_ID);
          $ingredient->setDescription($F_Descr);
          $ingredient->setAmount($IngredientAmount);
          $ingredient->setUnit($IngredientUnit);

          if($N_ID != null){
            //new Nutrient
            $lastNutrientId = $N_ID;

            $nutrient = new Nutrient();
            $nutrient->setId($N_ID);
            $nutrient->setDescription($N_Descr);
            $nutrient->setUnit($N_Unit);
            $nutrient->setAmount($N_Amount);

            //Add nutrient to ingredient
            $ingredient->addNutrient($nutrient->getObjectAsArray());
          }

          //Add ingredient to recipe
          $recipe->addIngredient($ingredient->getObjectAsArray());
        }else{
          //TODO extend ingredient and filter NULL
          $changesingredient = false;
          //Same ingredient check new nutrient
          if($lastNutrientId != $N_ID){
              //remove old ingredient
              $recipe->removeIngredient($ingredient->getObjectAsArray());
              
              //update id
              $lastNutrientId = $N_ID;
              $changesingredient = true;

              $nutrient = new Nutrient();
              $nutrient->setId($N_ID);
              $nutrient->setDescription($N_Descr);
              $nutrient->setUnit($N_Unit);
              $nutrient->setAmount($N_Amount);

              //Update object
              $ingredient->addNutrient($nutrient->getObjectAsArray());
              $recipe->addIngredient($ingredient->getObjectAsArray());
          }


        }
      }


    
    }

    //Update object
    if(empty($searchArray["recipe"])){
      array_push($searchArray["recipe"], $recipe->getObjectAsArray());
    }else{
      //Update recipe
      $searchArray["recipe"][$index] = $recipe->getObjectAsArray(); 
    }


  }

  if(!empty($searchArray["recipe"])){
    // set response code 200
    http_response_code(200);
    echo json_encode($searchArray);
  }else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no result found
    $searchArray["message"] = "No recipe found.";
    echo json_encode($searchArray);
  }
  
}else{
   // set response code - 500
   http_response_code(500);
  
   // tell the user no result found
   $searchArray["message"] = "Internal Server Error";
   echo json_encode($searchArray);
}



?>