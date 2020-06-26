import { Component, OnInit } from '@angular/core';
import { Ingredient } from 'src/app/ingredient';
import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';
import { SearchReqService } from 'src/app/search-req.service';
import { AuthenticationService } from 'src/app/authentication.service';
import { SearchParameter } from 'src/app/searchParameter';

@Component({
  selector: 'app-create-recipe',
  templateUrl: './create-recipe.component.html',
  styleUrls: ['./create-recipe.component.scss']
})
export class CreateRecipeComponent implements OnInit {

  title: string;
  shortDescription: string;
  keyword: string;
  keywords: string[] = [];
  ingredient: string;
  ingredients: Ingredient[] = [];
  description: string;
  picture: File;
  servings: number;
  duration: number;
  amount: number;
  unit: string;
  difficulty: string;
  options: string[] = [];

  serverIngredients: SearchParameter[] = [];
  serverKeywords: SearchParameter[] = [];
  allParamsOfIngredient:Ingredient;


  constructor(
    private recipeAdministrationReqService: RecipeAdministrationReqService, 
    private searchReqService: SearchReqService, 
    private authenticationService: AuthenticationService
  ) { }

  async ngOnInit() {
 this.serverIngredients = this.searchReqService.getIngredients();
      this.serverKeywords = this.searchReqService.getKeywords();
      console.log(this.serverIngredients);
  console.log(this.serverKeywords);
  }

  addIngredient(){
    let idIngredient: number;
    if (this.ingredient != null && this.amount != null && this.unit != null){
      idIngredient = this.recipeAdministrationReqService.convertRecipeIngredient(this.ingredient);
      this.allParamsOfIngredient = new Ingredient(
        idIngredient, 
        this.ingredient, 
        this.amount, 
        this.unit, 
        null)
       this.ingredient = null;
       this.amount = null;
       this.unit = null;

       this.ingredients.push(this.allParamsOfIngredient);
       this.allParamsOfIngredient= null;
     }
     else {
       window.alert("Bitte füge eine Zutat hinzu!");
     }
   }

   addKeyword(){
     if(this.keyword != null){
      this.keywords.push(this.keyword);
      this.keyword = "";
     }else {
       window.alert("Bitte füge ein Stichwort hinzu!");
     }
   }

   async createRecipe(){
     this.recipeAdministrationReqService.convertRecipeKeywordsArray(this.keywords);
     await this.recipeAdministrationReqService.getCreateRecipe(
       this.title,
      //this.picture,
       this.servings,
       this.shortDescription,
       this.description,
       this.duration,
       this.difficulty,
      //this.authenticationService.getUser().getId(),
       this.keywords,
       this.ingredients
     );
  
   }

}
