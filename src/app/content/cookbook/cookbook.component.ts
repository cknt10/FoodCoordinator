import { Component, OnInit } from '@angular/core';
import { Cookbook } from 'src/app/cookbook';
import { FormControl } from '@angular/forms';
import { CookbookReqService } from 'src/app/cookbook-req.service';
import { CookbookFormat } from 'src/app/cookbookFormat';

@Component({
  selector: 'app-cookbook',
  templateUrl: './cookbook.component.html',
  styleUrls: ['./cookbook.component.css']
})

export class CookbookComponent implements OnInit {

  choose: Boolean;
  created: Boolean;
  formats: CookbookFormat[];
  title: string;
  formatName: string;
  pages: number;
  cookbookFormat: CookbookFormat;


  constructor(
    private CookbookReqService: CookbookReqService,
  ) { }

  ngOnInit(): void {
  }

  chooseFormat(){
    this.choose = true;
    this.getFormats();
    console.log(this.formats);
  }

  async getFormats(){
    await this.CookbookReqService.getServerCookbookFormats().then((data) => {
    this.formats = data;});
    return this.formats;
    /*
    await this.CookbookReqService.getServerCookbookFormats().then((data) => {

      this.formats = data;
    })
    return this.formats;
    */
  }

  createCookbookFormat(){
    this.cookbookFormat.setFormat(this.formatName);
    this.cookbookFormat.setTitle(this.title);
    this.cookbookFormat.setPages(this.pages);
    console.log(this.cookbookFormat);
  }
}
