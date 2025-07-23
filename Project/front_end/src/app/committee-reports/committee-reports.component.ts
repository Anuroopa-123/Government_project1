import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-committee-reports',
  standalone: true,
  imports: [CommonModule,FormsModule],
  templateUrl: './committee-reports.component.html',
  styleUrl: './committee-reports.component.css'
})
export class CommitteeReportsComponent {

  chapters = [
    { 
      content: 'This is the content for chapter 1.',
      feedback: [
        { text: 'Feedback for Chapter 1: Union-State Relations Committee aims to strengthen the cooperative federal structure of India.' },
        { text: 'Feedback for Chapter 1: The historical recommendations reviewed have been helpful.' }
      ]
    },
    {
      content: 'This is the content for chapter 2.',
      feedback: [
        { text: 'Feedback for Chapter 2: Effective collaboration ensures both national unity and regional autonomy thrive together.' },
      ]
    },
    {
      content: 'This is the content for chapter 3.',
      feedback: []
    },
    {
      content: 'This is the content for chapter 4.',
      feedback: []
    },
    {
      content: 'This is the content for chapter 5.',
      feedback: []
    }
  ];

  // Variables to manage active chapter and feedback visibility
  selectedChapter = 0;
  feedbackVisible: boolean[] = [false, false, false, false, false];

  constructor() { }

  ngOnInit(): void { }

  // Select Chapter and switch tabs
  selectChapter(index: number): void {
    this.selectedChapter = index;
  }

  // Toggle visibility of feedback form
  toggleFeedback(index: number): void {
    this.feedbackVisible[index] = !this.feedbackVisible[index];
  }
}
