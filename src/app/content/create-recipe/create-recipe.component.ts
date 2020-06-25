import { Component, OnInit } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import { Ingredient } from 'src/app/ingredient';
import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';
import { SearchReqService } from 'src/app/search-req.service';
import { User } from '../../user';
import { AuthenticationService } from 'src/app/authentication.service';

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
  allParamsOfIngredient:Ingredient;
  ingredients: Ingredient[] = [];
  description: string;
  picture: File;
  servings: number;
  duration: number;
  amount: number;
  unit: string;
  difficulty: string;
  
  createonDate: Date = new Date();


  constructor(
    private recipeAdministrationReqService: RecipeAdministrationReqService, 
    private searchReqService: SearchReqService, 
    private authenticationService: AuthenticationService
  ) { }

  async ngOnInit() {
    await this.searchReqService.fetchSearchKeywords().then(data =>
      console.log(this.searchReqService.filterKeywords()));

      console.log(this.authenticationService.getUser());
    
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
     }
     else {
       window.alert("Bitte füge eine Zutat hinzu!");
     }
   }

   async createRecipe(){
     await this.recipeAdministrationReqService.getCreateRecipe(
       this.title,
       this.picture,
       this.servings,
       this.shortDescription,
       this.description,
       this.createonDate,
       this.duration,
       //this.difficulty,
      this.authenticationService.getUser().getId(),
       this.keywords,
       this.ingredients
     );
  
   }

}
