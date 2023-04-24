import { Component } from '@angular/core';

@Component({
  selector: 'app-data',
  templateUrl: './data.component.html',
  styleUrls: ['./data.component.css']
})
export class DataComponent {
  public title :string ="Actualiza los datos";

  onSubmit(){
    console.log("user");
  }
}
