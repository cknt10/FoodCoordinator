import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Ingredient} from 'src/app/ingredient';
import { Recipe } from 'src/app/recipe';
import { ActivatedRoute } from '@angular/router';
import { AuthenticationService } from 'src/app/authentication.service';
import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';
import { SearchReqService } from 'src/app/search-req.service';
import { FormControl, Validators } from '@angular/forms';
import { SearchParameter } from 'src/app/searchParameter';

@Component({
  selector: 'app-change-recipe',
  templateUrl: './change-recipe.component.html',
  styleUrls: ['./change-recipe.component.scss']
})

export class ChangeRecipeComponent implements OnInit {
  recipe: Recipe;
  title: string;
  difficulty: string;
  difficultyOptions: String[] = [];
  shortDescription: String;
  keyword: string;
  keywords: string[] = [];
  options: String[] = [];
  amount: number;
  unit: string;
  units: String[] = [];
  ingredient: string;
  ingredients: Ingredient[] = [];
  description: string;
  duration: any;
  servings: number;
  instruction: string;
  allParamsOfIngredient: Ingredient;
  imageUrl: String;
  fileToUpload: File = null;
  picture: string;

  drop = new FormControl();
  dro = new FormControl();
  authenticationService: any;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private user: AuthenticationService,
    private recipeAdministrationReqService: RecipeAdministrationReqService,
    public searchReqService: SearchReqService,
    ) { }

  async ngOnInit(): Promise<void> {
    this.getRecipe();

    this.difficultyOptions = this.recipeAdministrationReqService.getDifficulty();
    this.units = this.recipeAdministrationReqService.getUnit();
    await this.searchReqService.getServerKeywords();
    await this.searchReqService.getServerIngredients();
  }

// Recipe
  async getRecipe(): Promise<Recipe> {
    const id = +this.route.snapshot.paramMap.get('id');

    await this.recipeAdministrationReqService
      .fetchServerRecipeDetails(id)
      .then((data: Recipe) => {
        data['recipe'].forEach((value) =>{
          this.recipe = new Recipe(value);

        })
      });

      console.log(this.recipe);
      this.setValues();

    return this.recipe;
  }

  // set the Values
  setValues() {
    this.title = this.recipe.getTitle();
    this.difficulty = this.recipe.getDifficulty();
    this.shortDescription = this.recipe.getDescription();
    this.keywords = this.recipe.getKeywords();
    this.ingredients = this.recipe.getIngredients();
    this.duration = this.recipe.getDuration();
    this.servings = this.recipe.getServings();
    this.instruction = this.recipe.getInstruction();
  }

  handleFileInput(file: FileList){
    this.fileToUpload= file.item(0);
    //Show image preview
    var reader= new FileReader();
    reader.readAsDataURL(this.fileToUpload);
    let text = reader;
    reader.onload = (event:any) =>{
      console.log(text.result)
      this.imageUrl = <string>text.result;
      this.picture = <string>text.result;
    };
  }

  addKeyword(){
    if(!this.keywords.includes(this.keyword)){
      this.keywords.push(this.keyword);
    }
    else{
      window.alert('Das Schlüsselwort existiert bereits');
    }
    this.keyword = '';
  }

  removeKeyword(i: number){
    this.keywords.splice(i, 1);
  }

  addIngredient() {
    let idIngredient: number;
    if (this.description != null && this.amount != null && this.unit != null) {
     idIngredient = this.recipeAdministrationReqService.convertRecipeIngredient(
      this.description);
      this.allParamsOfIngredient = new Ingredient(
        idIngredient,
        this.description,
        this.amount,
        this.unit,
        null);
      console.log(idIngredient, this.description, this.amount, this.unit)
      this.description = null;
      this.amount = null;
      this.unit = null;
      this.ingredients.push(this.allParamsOfIngredient);
      console.log(this.ingredients);
      this.allParamsOfIngredient = null;
    }
    else {
      window.alert('Bitte füge eine Zutat hinzu!');
    }
  }

  removeIngredient(i: number){
    this.ingredients.splice(i, 1);
  }

  async changeRecipe(){
    this.addIngredient();
    this.addKeyword();
    if(this.title != null && this.difficulty != null && this.shortDescription != null && this.duration != null && this.servings != null && this.description != null){
      console.log(await this.recipeAdministrationReqService.getServerChangeRecipe(
        this.recipe.getId(),
        this.title,
        this.picture,
        this.servings,
        this.description,
        this.instruction,
        this.duration,
        this.difficulty,
        this.authenticationService.getUser().getId(), //ein wenig geschummelt (siehe oben in der Deklaration)
        this.keywords,
        this.ingredients)); //Bitte füge eine Zutat hinzu?? Kann evtl nicht an das Edresultat weitergegeben werden??
    }
    else{
      window.alert('Bitte füllen sie alle Felder aus.');
    }
    this.picture = null;
    this.imageUrl="/assets/ich.jpg";
  }
}
