import { Component, OnInit, Input } from '@angular/core';
import { Recipe } from 'src/app/recipe';
import { ActivatedRoute } from '@angular/router';
import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';
import { Location } from '@angular/common';
import { Ingredient } from 'src/app/ingredient';
import { Ratings } from 'src/app/ratings';
import { AuthenticationService } from 'src/app/authentication.service';
import { User } from 'src/app/User';
import { Nutrient } from 'src/app/nutrient';

@Component({
  selector: 'app-recipe-details',
  templateUrl: './recipe-details.component.html',
  styleUrls: ['./recipe-details.component.scss']
})
export class RecipeDetailsComponent implements OnInit {
  recipe: Recipe;
  spezingredients: Ingredient[] = [];
  speziNutrients: Nutrient[][] = [];
  ratings: Ratings[] = [];

  amount: number[]=[];
  unit: string[]=[];
  description: string[]=[];

  userIsPremium: boolean = false;

  constructor(
    private route: ActivatedRoute,
    private recipeAdministrationReqService: RecipeAdministrationReqService,
    private location: Location, 
    private authenticationService: AuthenticationService
  ) { }

  async ngOnInit() {
    await this.getRecipe();
    this.spezingredients=this.recipe.getIngredients();
    console.log(this.spezingredients);

    /*this.setIngredients();
    this.setRatings();*/

  }

  async getRecipe(): Promise<Recipe> {
    const id = +this.route.snapshot.paramMap.get('id');
    this.isPremium();
    await this.recipeAdministrationReqService.getServerRecipeDetails(id).then ((data: Recipe) => {
      this.recipe = data;
    })
      //.subscribe(recipe => this.recipe = recipe);
      console.log(this.recipe);
      return this.recipe;

  }

  throwError() {
    console.log(this.recipeAdministrationReqService.getErrorMessage());
    //window.alert(this.error);
  }

  setIngredients(){
    //this.ingredients = this.recipe.getIngredients();
    console.log(this.spezingredients);
  }

  setRatings(){
    this.ratings = this.recipe.getRatings();
    console.log(this.ratings);
  }

  goBack(): void {
    this.location.back();
  }

  isPremium():boolean{
    if(this.authenticationService.getUser() != null){
    return this.userIsPremium = this.authenticationService.getUser().getIsPremium();
    }else{
      return this.userIsPremium;
    }
  }
}
