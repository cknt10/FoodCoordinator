import { Component, OnInit, Input } from '@angular/core';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';
import { ActivatedRoute } from '@angular/router';
import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';
import { Location } from '@angular/common';
import { Ingredient } from 'src/app/ingredient';

@Component({
  selector: 'app-recipe-details',
  templateUrl: './recipe-details.component.html',
  styleUrls: ['./recipe-details.component.scss']
})
export class RecipeDetailsComponent implements OnInit {
  recipe: Recipe;
  ingredients: Ingredient[] = [];

  constructor(
    private route: ActivatedRoute,
    private searchReqService: SearchReqService,
    private recipeAdministrationReqService: RecipeAdministrationReqService,
    private location: Location
  ) { }

  ngOnInit(): void {
    this.getRecipe();
  }

  /*async ngOnInit() {
    this.recipe = this.searchReqService.getUserResults();
  }*/

  getRecipe(): void {
    const id = +this.route.snapshot.paramMap.get('id');
    this.searchReqService.getRecipe(id)
      .subscribe(recipe => this.recipe = recipe);
      console.log(this.recipe);
      this.setIngredients();
  }

  throwError() {
    console.log(this.recipeAdministrationReqService.getErrorMessage());
    //window.alert(this.error);
  }

  setIngredients(){
    this.ingredients = this.recipe.getIngredients();
    console.log(this.ingredients);
  }

  goBack(): void {
    this.location.back();
  }
}
