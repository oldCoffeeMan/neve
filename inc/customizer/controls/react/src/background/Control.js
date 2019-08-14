import BackgroundComponent from './BackgroundComponent.js';

export const BackgroundControl = wp.customize.Control.extend( {
	renderContent: function renderContent() {
		let control = this;
		ReactDOM.render(
				<BackgroundComponent control={control}/>,
				control.container[0]
		);
	}
} );
