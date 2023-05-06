import { Component } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {
  constructor(private request: RequestService) {}

  get currentUser() {
    return this.request.getCurrentUser();
  }


}
