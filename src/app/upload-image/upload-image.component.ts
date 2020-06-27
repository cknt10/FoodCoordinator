import { Component, OnInit } from '@angular/core';
import { UploadImageService } from '../upload-image.service';

@Component({
  selector: 'app-upload-image',
  templateUrl: './upload-image.component.html',
  styleUrls: ['./upload-image.component.css'],
  providers:[UploadImageService]

})
export class UploadImageComponent implements OnInit {

imageUrl : string = "/assets/img/ich.jpg";
fileToUpload : File = null;

  constructor(
    private imageService: UploadImageService
  ) { }

  ngOnInit(): void {
  }

handleFileInput(file: FileList){
this.fileToUpload= file.item(0);

//Show image preview
var reader= new FileReader();
reader.onload = (event:any) =>{
  this.imageUrl = event.target.result;
}
reader.readAsDataURL(this.fileToUpload);
}

OnSubmit(Caption, Image){
this.imageService.postfile(Caption.value, this.fileToUpload).subscribe(
  data =>{
    console.log('done');
    Caption.value= null;
    Image.value= null;
    this.imageUrl= "/assets/img/ich.jpg";
  }
);
}

}
