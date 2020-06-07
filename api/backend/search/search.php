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


function search($keywords, $conn){

  //Basic Recipe Search
 $query = 'SELECT * FROM (
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
    $stmt = $conn->prepare($query);

    //sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    //bind
    $stmt->bindParam(":KW_Name", $keywords);
    $stmt->bindParam(":F_Descr", $keywords);


    // execute query
    $stmt->execute();



    return $stmt;
}

//Call Function
$searchResults = search($testData, $db);
$num = $searchResults->rowCount();
//recipe
$_lastID = -1;
$_index = -1;
//ingredient
$_ingredient = new Ingredient();
$_lastIngredientId = -1;
$_ingredientindex = -1;


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
    $_changesingredient = false;

    //remember last recipe Id for push
    if($_lastID != $R_ID){
      //unique recipe id
      $_lastID = $R_ID;
      $_index++;

      //instantiate classes
      $_recipe = new Recipe();

      $_recipe->setId($R_ID);
      $_recipe->setTitle($Title);
      $_recipe->setPicture($picture);
      $_recipe->setDescription($R_Descr);
      $_recipe->setInstruction($instruction);
      $_recipe->setDuration($R_Descr);
      $_recipe->setCreationDate($creationDate);
      $_recipe->setLastChange($LastChange);
      $_recipe->setDifficulty($Difficulty);
      $_recipe->setCertified($certified);
      if($KW_Name != null) {$_recipe->addKeyword($KW_Name);}
      $_recipe->setServings($servings);
      $_recipe->setCreatedUser($U_ID);
      
      $_rating = new Rating($RatingUserId, $BananaAmount, $Comment);
      if($_rating->getUserId != null && $_rating->getComment != null && $_rating->getRating != null){
        $_recipe->addRating($_rating->getObjectAsArray());
      }
      
      if($F_ID != null){
        $_ingredient = new Ingredient();
        $_ingredient->setId($F_ID);
        $_ingredient->setDescription($F_Descr);
        $_ingredient->setAmount($IngredientAmount);
        $_ingredient->setUnit($IngredientUnit);
        
        //Update indexes
        $_lastIngredientId = $F_ID;
        $_ingredientindex++;

        if($N_ID != null){
          $_nutrient = new Nutrient();
          $_nutrient->setId($N_ID);
          $_nutrient->setDescription($N_Descr);
          $_nutrient->setUnit($N_Unit);
          $_nutrient->setAmount($N_Amount);
          $_lastNutrientId = $N_ID;
    
          $_ingredient->addNutrient($_nutrient->getObjectAsArray());
        }
        $_recipe->addIngredient($_ingredient->getObjectAsArray());
      }
    }else{
      //Same recipe id therefore extend properties

      //Extend object if not null
      if($KW_Name != null){$_recipe->addKeyword($KW_Name);}

      $_rating = new Rating($RatingUserId, $BananaAmount, $Comment);
      //Add only not emty Objects
      if($_rating->getUserId != null && $_rating->getComment != null && $_rating->getRating != null){
        $_recipe->addRating($_rating->getObjectAsArray());
      }

      //Only if ingredient exists
      if($F_ID != null){
        //Check if new Ingredient
        if($_lastIngredientId != $F_ID || $_ingredientindex == -1){
          $_lastIngredientId = $F_ID;
          $_ingredientindex++;
          $_changesingredient = true;

          //create new Ingredient
          $_ingredient = new Ingredient();
          $_ingredient->setId($F_ID);
          $_ingredient->setDescription($F_Descr);
          $_ingredient->setAmount($IngredientAmount);
          $_ingredient->setUnit($IngredientUnit);

          if($N_ID != null){
            //new Nutrient
            $_lastNutrientId = $N_ID;

            $_nutrient = new Nutrient();
            $_nutrient->setId($N_ID);
            $_nutrient->setDescription($N_Descr);
            $_nutrient->setUnit($N_Unit);
            $_nutrient->setAmount($N_Amount);

            //Add nutrient to ingredient
            $_ingredient->addNutrient($_nutrient->getObjectAsArray());
          }

          //Add ingredient to recipe
          $_recipe->addIngredient($_ingredient->getObjectAsArray());
        }else{
          //TODO extend ingredient and filter NULL
          $_changesingredient = false;
          //Same ingredient check new nutrient
          if($_lastNutrientId != $N_ID){
              //remove old ingredient
              $_recipe->removeIngredient($_ingredient->getObjectAsArray());
              
              //update id
              $_lastNutrientId = $N_ID;
              $_changesingredient = true;

              $_nutrient = new Nutrient();
              $_nutrient->setId($N_ID);
              $_nutrient->setDescription($N_Descr);
              $_nutrient->setUnit($N_Unit);
              $_nutrient->setAmount($N_Amount);

              //Update object
              $_ingredient->addNutrient($_nutrient->getObjectAsArray());
              $_recipe->addIngredient($_ingredient->getObjectAsArray());
          }


        }
      }


    
    }

    //Update object
    if(empty($searchArray["recipe"])){
      array_push($searchArray["recipe"], $_recipe->getObjectAsArray());
    }else{
      //Update recipe
      $searchArray["recipe"][$_index] = $_recipe->getObjectAsArray(); 
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