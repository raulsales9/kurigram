import { Component, OnInit } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { Post } from 'src/app/models/post';

@Component({
  selector: 'app-post-form',
  templateUrl: './new-post.component.html',
})
export class PostFormComponent implements OnInit {

  newPost: Post = {
    _id: '',
    text: '',
    image: '',
    created_at: '',
    user: '',
    likes: 0,
    isSubmitted: 1,
    title: ''
  };

  constructor(private requestService: RequestService) { }

  ngOnInit(): void {
  }

  onSubmit(): void {
    this.requestService.insertPost(this.newPost)
      .subscribe(
        res => {
          console.log(res);
          this.newPost = {
            _id: '',
            text: '',
            image: '',
            created_at: '',
            user: '',
            likes: 0,
            isSubmitted: 1,
            title: ''
          };
        },
        error => {
          console.log(error);
        }
      );
  }
}
  
  
  