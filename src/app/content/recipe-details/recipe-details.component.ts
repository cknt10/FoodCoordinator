import { Component, OnInit, Input } from '@angular/core';
import { Recipe } from 'src/app/recipe';
import { ActivatedRoute } from '@angular/router';

import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';
import { AuthenticationService } from '../../authentication.service';

import { Ingredient } from 'src/app/ingredient';
import { Ratings } from 'src/app/ratings';
import { Nutrient } from 'src/app/nutrient';

@Component({
  selector: 'app-recipe-details',
  templateUrl: './recipe-details.component.html',
  styleUrls: ['./recipe-details.component.scss'],
})
export class RecipeDetailsComponent implements OnInit {
  recipe: Recipe;
  ingredients: Ingredient[] = [];
  nutrients: Nutrient[] = [];
  nut: Nutrient[][] = [];
  ratings: Ratings[] = [];

  constructor(
    private route: ActivatedRoute,
    private recipeAdministrationReqService: RecipeAdministrationReqService,
    private user: AuthenticationService
  ) {}

  async ngOnInit() {
    await this.getRecipe();

    console.log(this.ingredients);
    console.log(this.ratings);
    console.log(this.getNutrient());
  }

  async getRecipe(): Promise<Recipe> {
    const id = +this.route.snapshot.paramMap.get('id');

    let isPremium: boolean;
    if(this.user.getUser() != null ){
      isPremium = this.user.getUser().getIsPremium();
    }else{
      isPremium = false;
    }

    await this.recipeAdministrationReqService
      .getServerRecipeDetails(id, isPremium)
      .then((data: Recipe) => {
        this.recipe = data;
        this.ingredients = this.recipe.getIngredients();
        this.ratings = this.recipe.getRatings();
      });
    return this.recipe;
  }

  throwError() {
    console.log(this.recipeAdministrationReqService.getErrorMessage());
    //window.alert(this.error);
  }

  getNutrient(){

    let count: number;
    this.ingredients.forEach((value) => {
      if(value.nutrients != null){
        this.nut[count] = value.nutrients;
      }
    });
    console.log(this.nut);
  }



}
