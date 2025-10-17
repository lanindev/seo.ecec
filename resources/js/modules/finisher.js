import '../plugins/finisher-header.es5.min.js';

export function initFinisherHeader() {
    new FinisherHeader({
        count: 4,
        size: {
            min: 500,
            max: 700,
            pulse: 0.3,
        },
        speed: {
            x: {
                min: 1,
                max: 1.2,
            },
            y: {
                min: 0,
                max: 0.1,
            },
        },
        colors: {
            background: '#ffffff',
            particles: ['#e4005b', '#f2971a', '#8dc220', '#096fac'],
        },
        blending: 'lighten',
        opacity: {
            center: 0.35,
            edge: 0,
        },
        skew: 0,
        shapes: ['c'],
    });
}
