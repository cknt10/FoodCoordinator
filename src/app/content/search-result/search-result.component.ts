import { Component, OnInit, Input } from '@angular/core';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';
import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';

@Component({
  selector: 'app-search-result',
  templateUrl: './search-result.component.html',
  styleUrls: ['./search-result.component.scss']
})
export class SearchResultComponent implements OnInit {
  recipes: Recipe;
  results: [];
  ratingCount: number;

  constructor(
    private searchReqService: SearchReqService,
    private recipeAdministrationReqService: RecipeAdministrationReqService
  ) { }

  async ngOnInit() {
    //console.log(await this.searchReqService.getUserResults());
    console.log(this.searchReqService.getUserResults());
  }

  throwError() {
    console.log(this.recipeAdministrationReqService.getErrorMessage());
    //window.alert(this.error);
  }



}
