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
                            keywords.KW_Name, 
                            BananaAmount, 
                            Comment, 
                            rating.U_ID AS RatingUserId,
                            PU_ID, 
                            FavDate, 
                            FavGroup, 
                            foodHasNutrients.N_ID, 
                            nutrients.N_Descr, 
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
$_lastID = -1;

if($num > 0){
//   //Analyze search results
  $searchArray=array();
  $searchArray["recipe"]=array();


  // retrieve our table contents
  // fetch() is faster than fetchAll()
  // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
  while ($row = $searchResults->fetch(PDO::FETCH_ASSOC)){
    // extract row
    // this will make $row['name'] to
    // just $name only
    extract($row);


    //remember last recipe Id for push
    if($_lastID != $R_ID){
      //unique recipe id
      $_lastID = $R_ID;

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
      $_recipe->setKeywords(array($KW_Name));
      $_recipe->setIngredients("TODO");
      $_recipe->setServings($servings);
      $_recipe->setType("TODO");
      $_recipe->setCreatedUser($U_ID);
      
      $_rating = new Rating($RatingUserId, $BananaAmount, $Comment);
      $_recipe->addRating($_rating->getObjectAsArray());

      // $_item["ingredient"] = array(
        

      // );
      // $_item["ingredient"]["nutrient"] = array(

      // );
      $_item = $_recipe->getObjectAsArray();
      array_push($searchArray["recipe"], $_item);
    }else{
      //same recipe id therefore extend properties



    }




  }


  echo json_encode($searchArray);
  //echo 'ok';
}



?>