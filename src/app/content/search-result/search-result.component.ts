import { Component, OnInit } from '@angular/core';
import { SearchReqService } from '../../search-req.service';

@Component({
  selector: 'app-search-result',
  templateUrl: './search-result.component.html',
  styleUrls: ['./search-result.component.scss']
})
export class SearchResultComponent implements OnInit {
  results: [];
  title: string;
  description: string;
  ratings: number;
  ratingCount: number;
  imgSrc: string;
  certified: boolean;

  constructor(
    private searchReqService: SearchReqService,
  ) { }

  ngOnInit(): void {
  }



}
