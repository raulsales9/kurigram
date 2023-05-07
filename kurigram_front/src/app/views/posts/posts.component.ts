import { Component,OnInit } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { Post } from 'src/app/models/post'; 
import { OwlOptions } from 'ngx-owl-carousel-o';

@Component({
  selector: 'app-posts',
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.css']
})
export class PostsComponent implements OnInit {

  like: number = 0;
  public onClick(){
    this.like++;
  }
  posts: Post[];
  carouselOptions: OwlOptions = {
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      },
      1000: {
        items: 5
      }
    },
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
  };

  constructor(private requestService: RequestService) {}

  ngOnInit() {
    this.requestService.getPosts().subscribe((posts) => {
      this.posts = posts;
    });
  }
}
