import { Component, OnInit, Input } from '@angular/core';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';

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
  ) { }

  async ngOnInit() {
    //console.log(await this.searchReqService.getUserResults());
    console.log(this.searchReqService.getUserResults());
  }



}
