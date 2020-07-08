import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthenticationService } from '../../authentication.service';
import { RecipeAdministrationReqService } from '../../recipe-administration-req.service';
import { PremiumReqService } from '../../premium-req.service'
import { Recipe } from 'src/app/recipe';

@Component({
  selector: 'app-my-recipes',
  templateUrl: './my-recipes.component.html',
  styleUrls: ['./my-recipes.component.scss']
})
export class MyRecipesComponent implements OnInit {
  recipes: Recipe[] = [];

  constructor(
    private authenticationService: AuthenticationService,
    private recipeAdministrationService: RecipeAdministrationReqService,
    private premiumReqService: PremiumReqService,
    private router: Router,
  ) { }

  ngOnInit(): void {
    this.getRecipes();
  }

  async getRecipes(){
    this.recipes = await this.recipeAdministrationService.getServerUserRecipe(this.authenticationService.getUser());
    console.log(this.recipes);
  }

  throwError() {
    console.log(this.recipeAdministrationService.getErrorMessage());
    //window.alert(this.error);
  }
}
